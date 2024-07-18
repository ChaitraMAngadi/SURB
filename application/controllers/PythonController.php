<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PythonController extends CI_Controller {

    public function index() {
        $pythonScript = 'pythonfile.py';
        $command = "python3 $pythonScript"; // Adjust the command based on your Python version

        // Execute the Python script
        $output = [];
        $returnVar = 0;
        exec($command, $output, $returnVar);
        

        // Display the output (for debugging purposes)
        echo '<pre>';
        print_r($output);
        echo '</pre>';
    }
}
