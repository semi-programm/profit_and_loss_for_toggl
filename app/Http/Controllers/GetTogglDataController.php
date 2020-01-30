<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use App\Model\Project;
use App\Model\Workspace;
use App\Model\ClientModel;
use App\Model\Tag;
use App\Model\User;
use App\Model\Task;
use App\Model\TimeEntries;
use Illuminate\Support\Carbon;

class GetTogglDataController extends Controller
{
    private function getWorkspaces()
    {
        $url = 'https://toggl.com/api/v8/';
        $workspace_id = '682318';
        $url .= 'workspaces';
        $client = new Client();
        $options = [
            'auth' => [
                config('toggl.toggl_token'),
                config('toggl.toggl_password')
            ]
        ];
        $response = $client->get($url, $options);
        $decoded = json_decode($response->getBody(), true);
        return $decoded;
    }

    public function saveWorkspaces()
    {
        $workspaces = self::getWorkspaces();
        foreach ($workspaces as $workspace) {
            Workspace::updateOrCreate(
                [
                    'id' => $workspace['id'],
                ],
                [
                    'id' => $workspace['id'],
                    // 'name' => $workspace['name'],
                ]
            );
        }
    }

    public function saveProjects()
    {
        $workspaces = Workspace::all();
        $workspaces->each(function ($workspace) {
            self::saveProject($workspace->id);
        });
    }

    private function getProjects($workspace_id)
    {
        $url = 'https://toggl.com/api/v8/';
        // $workspace_id = '682318';
        $url .= 'workspaces/' . $workspace_id . '/projects';
        $client = new Client();
        $options = [
            'auth' => [
                config('toggl.toggl_token'),
                config('toggl.toggl_password')
            ]
        ];
        $response = $client->get($url, $options);
        $decoded = json_decode($response->getBody(), true);
        return $decoded;
    }

    public function saveProject($workspace_id)
    {
        $projects = self::getProjects($workspace_id);
        foreach ($projects as $project) {
            Project::updateOrCreate(
                [
                    'id' => $project['id'],
                ],
                [
                    'client_id' => $project['cid'] ?? null,
                    'id' => $project['id'],
                    'name' => $project['name'],
                    'workspace_id' => $project['wid'],
                ]
            );
        }
    }

    public function saveClients()
    {
        $workspaces = Workspace::all();
        $workspaces->each(function ($workspace) {
            self::saveClient($workspace->id);
        });
    }

    public function getClients($workspace_id)
    {
        $url = 'https://toggl.com/api/v8/';
        $url .= 'workspaces/' . $workspace_id . '/clients';
        $client = new Client();
        $options = [
            'auth' => [
                config('toggl.toggl_token'),
                config('toggl.toggl_password')
            ]
        ];
        $response = $client->get($url, $options);
        $decoded = json_decode($response->getBody(), true);
        return $decoded;
    }

    public function saveClient($workspace_id)
    {
        $clients = self::getClients($workspace_id);
        foreach ($clients as $client) {
            ClientModel::updateOrCreate(
                [
                    'id' => $client['id'],
                ],
                [
                    'id' => $client['id'],
                    'name' => $client['name'],
                    'workspace_id' => $client['wid'],
                ]
            );
        }
    }

    public function saveUsers()
    {
        $workspaces = Workspace::all();
        $workspaces->each(function ($workspace) {
            self::saveUser($workspace->id);
        });
    }

    public function getUsers($workspace_id)
    {
        $url = 'https://toggl.com/api/v8/';
        $url .= 'workspaces/' . $workspace_id . '/users';
        $client = new Client();
        $options = [
            'auth' => [
                config('toggl.toggl_token'),
                config('toggl.toggl_password')
            ]
        ];
        $response = $client->get($url, $options);
        $decoded = json_decode($response->getBody(), true);
        return $decoded;
    }

    public function saveUser($workspace_id)
    {
        $users = self::getUsers($workspace_id);
        foreach ($users as $user) {
            User::updateOrCreate(
                [
                    'id' => $user['id'],
                ],
                [
                    'id' => $user['id'],
                    'name' => $user['fullname'],
                    // 'workspace_id' => $workspace_id,
                    'mail' => $user['email'],
                    'created_at_toggl' => $user['created_at'],
                ]
            );
        }
    }

    public function saveTags()
    {
        $workspaces = Workspace::all();
        $workspaces->each(function ($workspace) {
            self::saveTag($workspace->id);
        });
    }

    public function getTags($workspace_id)
    {
        $url = 'https://toggl.com/api/v8/';
        $url .= 'workspaces/' . $workspace_id . '/tags';
        $client = new Client();
        $options = [
            'auth' => [
                config('toggl.toggl_token'),
                config('toggl.toggl_password')
            ]
        ];
        $response = $client->get($url, $options);
        $decoded = json_decode($response->getBody(), true);
        return $decoded;
    }

    public function saveTag($workspace_id)
    {
        $tags = self::getTags($workspace_id);
        foreach ($tags as $tag) {
            Tag::updateOrCreate(
                [
                    'id' => $tag['id'],
                ],
                [
                    'id' => $tag['id'],
                    'name' => $tag['name'],
                    'workspace_id' => $tag['wid'],
                ]
            );
        }
    }

    public function saveTasks()
    {
        $workspaces = Workspace::all();
        $workspaces->each(function ($workspace) {
            self::saveTask($workspace->id);
        });
    }

    public function getTasks($workspace_id)
    {
        $url = 'https://toggl.com/api/v8/';
        $url .= 'workspaces/' . $workspace_id . '/tasks';
        $client = new Client();
        $options = [
            'auth' => [
                config('toggl.toggl_token'),
                config('toggl.toggl_password')
            ]
        ];
        $response = $client->get($url, $options);
        $decoded = json_decode($response->getBody(), true);
        return $decoded;
    }

    public function saveTask($workspace_id)
    {
        $tags = self::getTasks($workspace_id);
        foreach ($tags as $tag) {
            Task::updateOrCreate(
                [
                    'id' => $tag['id'],
                ],
                [
                    'id' => $tag['id'],
                    'name' => $tag['name'],
                    'workspace_id' => $tag['wid'],
                    'project_id' => $tag['pid'],
                    'est_sec' => $tag['estimated_seconds'],
                ]
            );
        }
    }

    public function getTimeEntries($workspace_id, $since, $until, $page)
    {
        $url = 'https://toggl.com/reports/api/v2/details';
        $client = new Client();
        $options = [
            'auth' => [
                config('toggl.toggl_token'),
                config('toggl.toggl_password')
            ],
            'query' => [
                'workspace_id' => $workspace_id,
                'since' => $since,
                'until' => $until,
                'user_agent' => 'api_test',
                'page' => $page,
            ]
        ];
        $response = $client->get($url, $options);
        $decoded = json_decode($response->getBody(), true);
        return $decoded;
    }

    // public function saveTimeEntry($workspace_id, $since, $until)
    public function saveTimeEntry($workspace_id, $since, $until, $page)
    {
        $entries = self::getTimeEntries($workspace_id, $since, $until, $page);
        foreach ($entries['data'] as $entry) {
            TimeEntries::updateOrCreate(
                [
                    'id' => $entry['id'],
                ],
                [
                    'id' => $entry['id'],
                    'project_id' => $entry['pid'] ?? null,
                    'user_id' => $entry['uid'],
                    'start' => Carbon::parse($entry['start'])->format('Y-m-d G:i:s'),
                    'stop' => $entry['end'] ? Carbon::parse($entry['end'])->format('Y-m-d G:i:s') : null,
                    'duration' => $entry['dur'] ?? null,
                    'description' => $entry['description'] ?? null,
                    'task_id' => $entry['tid'] ?? null,
                    'workspace_id' => $workspace_id,
                ]
            );
        }
    }

    public function saveTimeEntries($since, $until)
    {
        $workspaces = Workspace::all();
        $workspaces->each(function ($workspace) use($since, $until){
            $page = 1;
            $entries = self::getTimeEntries($workspace->id, $since, $until, $page);
            $count = ceil($entries['total_count'] / $entries['per_page']);

            for ($page=1; $page <= $count; $page++) {
                self::saveTimeEntry($workspace->id, $since, $until, $page);
            }
        });
    }
}
