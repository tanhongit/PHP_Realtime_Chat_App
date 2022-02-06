<?php

class Controller
{
    const VIEW_PATH = 'app/views';
    const MODEL_PATH = 'app/models';

    /**
     * index
     */
    public function index()
    {
        self::renderView('frontend.index');
    }

    /**
     * Path name - get after View folder
     * @param $viewPath
     * @param array $data
     */
    protected function renderView($viewPath, array $data = [])
    {
        //get data
        foreach ($data as $key => $value) {
            $$key = $value;
        }

        $viewPathFile = self::VIEW_PATH . '/' . str_replace('.', '/', $viewPath) . '.php';
        require $viewPathFile;
    }

    /**
     * @param $modelPath
     */
    protected function loadModel($modelPath)
    {
        $modelPathFile = self::MODEL_PATH . '/' . str_replace('.', '/', $modelPath) . '.php';
        require $modelPathFile;
    }
}
