<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class ScaffoldGenerator extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:scaffold';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description.';

    public function fire()
    {
        $this->call('make:controller', ['name' => $this->getNameInput() . 'Controller']);

        foreach (['WillBeSaved', 'WasSaved', 'WillBeUpdated', 'WasUpdated', 'WillBeDestroyed', 'WasDestroyed'] as $name) {
            $this->call('make:event', ['name' => $this->getNameInput() . '/' . $name]);
        }

        foreach (['CreateJob', 'DestroyJob', 'UpdateJob'] as $name) {
            $this->call('make:job', ['name' => $this->getNameInput() . '/' . $name]);
        }

        foreach (['CreateRequest', 'DestroyRequest', 'UpdateRequest'] as $name) {
            $this->call('make:request', ['name' => $this->getNameInput() . '/' . $name]);
        }
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        //
    }
}
