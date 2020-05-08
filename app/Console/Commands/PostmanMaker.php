<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;
use App\Support\Postman\CollectionWriter;
use App\Support\Postman\PostmanGenerator;
use Illuminate\Support\Str;
use Mpociot\ApiDoc\Generators\AbstractGenerator;

class PostmanMaker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:postman
            {--routePrefix= : The route prefix to use for generation}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command generate test api routes for postman';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return false|null
     */
    public function handle()
    {
        $generator = new PostmanGenerator();

        $routePrefix = $this->option('routePrefix');

        $parsedRoutes = $this->processLaravelRoutes($generator, $routePrefix);

        $parsedRoutes = collect($parsedRoutes)->groupBy('resource')->sort(function ($a, $b) {
            return strcmp($a->first()['resource'], $b->first()['resource']);
        });
        $this->writeMarkdown($parsedRoutes);
    }

    /**
     * @param  Collection $parsedRoutes
     *
     * @return void
     */
    private function writeMarkdown($parsedRoutes)
    {
        $this->info('Generating Postman collection');

        file_put_contents(public_path('postman/collection.json'), $this->generatePostmanCollection($parsedRoutes));
    }

    /**
     * @param AbstractGenerator  $generator
     * @param $allowedRoutes
     * @param $routePrefix
     *
     * @return array
     */
    private function processLaravelRoutes(AbstractGenerator $generator, $routePrefix)
    {
        $withResponse = false;
        $routes = Route::getRoutes();
        $bindings = [];
        $parsedRoutes = [];
        foreach ($routes as $route) {
            if (strpos($generator->getUri($route), $routePrefix) !== false) {
                if ($this->isValidRoute($route)) {
                    $include = $this->prepareInclude($route);
                    $r = $generator->processRoute($route, $bindings, "", $withResponse);
                    $r['uri'] .= $include;
                    $parsedRoutes[] = $r;
                    $this->info('Processed route: ['.implode(',', $generator->getMethods($route)).'] '.$generator->getUri($route));
                } else {
                    $this->warn('Skipping route: ['.implode(',', $generator->getMethods($route)).'] '.$generator->getUri($route));
                }
            }
        }
        $parsedRoutes = $this->clearValues($parsedRoutes);
        return $parsedRoutes;
    }

    /**
     * @param $route
     *
     * @return bool
     */
    private function isValidRoute($route)
    {
        return ! is_callable($route->getAction()['uses']) && ! is_null($route->getAction()['uses']);
    }

    /**
     * @param $parsedRoutes
     *
     * @return $parsedRoutes
     */
    private function clearValues($parsedRoutes)
    {
        foreach ($parsedRoutes as $key => $route) {
            foreach ($route['parameters'] as $key1 => $parameter) {
                $parsedRoutes[$key]['parameters'][$key1]['value'] = "";
            }
        }
        return $parsedRoutes;
    }

    /**
     * Generate Postman collection JSON file.
     *
     * @param Collection $routes
     *
     * @return string
     */
    private function generatePostmanCollection(Collection $routes)
    {
        $writer = new CollectionWriter($routes);

        return $writer->getCollection();
    }

    /**
     * Prepare default include for attach/detach
     *
     * @param $route
     */
    private function prepareInclude($route)
    {
        $include = '';
        $attach = str_contains($route->getName(), 'attach');
        $detach = str_contains($route->getName(), 'detach');
        if ($attach || $detach) {
            $includeArray = explode('.', $route->getName());
            if ($includeArray > 0) {
                $include = '?include=' .
                    lcfirst(
                        str_plural(
                            $detach ?
                                str_replace('detach', '', $includeArray[1])
                                : str_replace('attach', '', $includeArray[1])
                        )
                    );
            }
        }
        return $include;
    }
}
