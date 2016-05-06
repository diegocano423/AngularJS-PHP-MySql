<?php
namespace App\Controllers;

use App\Services\GameService;
use Slim\Http\Request;

class GameController {
	private $GameService;

    public function __construct() {
        $this->GameService = new GameService();
    }

	public function create ($request) {
        $result = [];
        $data = $request->getParsedBody();
        
        if (array_key_exists("title", $data)) {
        	$title = $data["title"];
        } else {
        	$result = [
                "error" => true,
                "message" => "title field is missing."
            ];
            return $result;
        }
 
        if (array_key_exists("description", $data)) {
        	$description = $data["description"];
        } else {
        	$result = [
                "error" => true,
                "message" => "description field is missing."
        	];
        	return $result;
        }

        if (array_key_exists("developer", $data)) {
        	$developer = $data["developer"];
        } else {
        	$result = [
                "error" => true,
                "message" => "developer field is missing."
        	];
        	return $result;
        }

        if (array_key_exists("console", $data)) {
        	$console = $data["console"];
        } else {
        	$result = [
                "error" => true,
                "message" => "console field is missing."
        	];
        	return $result;
        }

        if (array_key_exists("release", $data)) {
        	$release = $data["release"];
        } else {
        	$result = [
                "error" => true,
                "message" => "release date field is missing."
        	];
        	return $result;
        }

        if (isset($title, $description, $developer, $console, $release)) {
            $result = $this->GameService->create($title, $description, $developer, $console, $release);
            return $result; 
        } else {
        	$result['error'] = true;
        	$result['message'] = 'You must send all the information required in order to create a new game';
        }
        return $result;
	}

    public function edit ($request) {
        $result = [];
        $data = $request->getParsedBody();
        
        if (array_key_exists("title", $data)) {
            $title = $data["title"];
        } else {
            $result = [
                "error" => true,
                "message" => "The title edit field is missing."
            ];
            return $result;
        }
 
        if (array_key_exists("description", $data)) {
            $description = $data["description"];
        } else {
            $result = [
                "error" => true,
                "message" => "The description edit field is missing."
            ];
            return $result;
        }

        if (array_key_exists("developer", $data)) {
            $developer = $data["developer"];
        } else {
            $result = [
                "error" => true,
                "message" => "The developer edit field is missing."
            ];
            return $result;
        }

        if (array_key_exists("console", $data)) {
            $console = $data["console"];
        } else {
            $result = [
                "error" => true,
                "message" => "The console edit field is missing."
            ];
            return $result;
        }

        if (array_key_exists("release", $data)) {
            $release = $data["release"];
        } else {
            $result = [
                "error" => true,
                "message" => "The release date edit field is missing."
            ];
            return $result;
        }

        if (isset($title, $description, $developer, $console, $release)) {
            $result = $this->GameService->edit($title, $description, $developer, $console, $release);
            return $result; 
        } else {
            $result['error'] = true;
            $result['message'] = 'You must send all the information required in order to edit a game';
        }

        return $result;
    }

    public function delete ($request) {
        $result = [];
        $title = $request['title'];
        if (isset($title)) {
            $result = $this->GameService->delete($title);
        } else { 
            $result = [
                'error' => true,
                'message' => "We couldn't delete the requested game."
            ];
        }
        
        return $result;
    }

    public function getAll () {
        $result = $this->GameService->getAll();

        return $result;
    }

    public function getOne ($request) {
        $result = [];
        $title = $request['title'];

        if (isset($title)) {
            $result = $this->GameService->getOne($title);
        } else {
            $result = [ 
                'error' => true,
                'message' => "We couldn't find the requested game."
            ];
        }

        return $result;
    }
}