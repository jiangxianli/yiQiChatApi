<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class MakeTransformer extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:transformer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '';

    protected $transform = '';

    /**
     * Execute the console command.
     */
    public function fire()
    {
        if ($name = $this->option('model')) {
            $name = str_replace('/', '\\', $name);

            if (class_exists($name)) {
                $model = $this->laravel->make($name);

                $table  = $model->getConnection()->getTablePrefix() . $model->getTable();
                $schema = $model->getConnection()->getDoctrineSchemaManager($table);

                $columns = $schema->listTableColumns($table);
                if ($columns) {
                    foreach ($columns as $column) {
                        $name = $column->getName();
                        $this->transform .= "            '{$name}' => \$transform->{$name},\n";
                    }
                }
            } else {
                return $this->error('Model does not exist.');
            }
        } else {
            return $this->error('Missing required option: --model');
        }

        parent::fire();
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/stubs/transformer.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string $rootNamespace
     *
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Transformers';
    }

    /**
     * Build the class with the given name.
     *
     * @param  string $name
     *
     * @return string
     */
    protected function buildClass($name)
    {
        $stub = parent::buildClass($name);

        $stub = str_replace(
            'TransformContent', $this->transform, $stub
        );

        return $stub;
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['model', 'm', InputOption::VALUE_OPTIONAL, 'model name'],
        ];
    }
}
