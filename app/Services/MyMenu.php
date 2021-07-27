<?php

namespace App\Services;

use App\Models\Admin\Contact;
use App\Models\Admin\Campaign;
use Pratiksh\Adminetic\Traits\SidebarHelper;
use Pratiksh\Adminetic\Contracts\SidebarInterface;

class MyMenu implements SidebarInterface
{
    use SidebarHelper;

    public function myMenu(): array
    {
        return [
            [
                'type' => 'breaker',
                'name' => 'Marketing',
                'description' => 'Marketing Modules',
            ],
            [
                'type' => 'menu',
                'name' => 'Contacts',
                'icon' => 'fa fa-book',
                'is_active' => request()->routeIs('contact*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', App\Models\Admin\Contact::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', App\Models\Admin\Contact::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('contact', App\Models\Admin\Contact::class)
            ],
            [
                'type' => 'menu',
                'name' => 'Campaigns',
                'icon' => 'fa fa-bell',
                'is_active' => request()->routeIs('campaign*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', App\Models\Admin\Campaign::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', App\Models\Admin\Campaign::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('campaign', App\Models\Admin\Campaign::class)
            ],
            [
                'type' => 'menu',
                'name' => 'Tasks',
                'icon' => 'fa fa-tasks',
                'is_active' => request()->routeIs('task*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', App\Models\Admin\Task::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', App\Models\Admin\Task::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('task', App\Models\Admin\Task::class)
            ],
            [
                'type' => 'menu',
                'name' => 'Leads',
                'icon' => 'fa fa-lightbulb-o',
                'is_active' => request()->routeIs('lead*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', App\Models\Admin\Lead::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', App\Models\Admin\Lead::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('lead', App\Models\Admin\Lead::class)
            ],
            [
                'type' => 'menu',
                'name' => 'Packages',
                'icon' => 'fa fa-shopping-basket',
                'is_active' => request()->routeIs('package*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', App\Models\Admin\Package::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', App\Models\Admin\Package::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('package', App\Models\Admin\Package::class)
            ],
            [
                'type' => 'menu',
                'name' => 'Discussions',
                'icon' => 'fa fa-comment',
                'is_active' => request()->routeIs('discussion*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', App\Models\Admin\Discussion::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', App\Models\Admin\Discussion::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('discussion', App\Models\Admin\Discussion::class)
            ],
            [
                'type' => 'menu',
                'name' => 'Projects',
                'icon' => 'fa fa-coffee',
                'is_active' => request()->routeIs('project*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', App\Models\Admin\Project::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', App\Models\Admin\Project::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('project', App\Models\Admin\Project::class)
            ],
            [
                'type' => 'link',
                'name' => ' Payments',
                'icon' => 'fa fa-money',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', App\Models\Admin\Payment::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', App\Models\Admin\Payment::class),
                    ],
                ],
                'link' => adminRedirectRoute('payment'),
            ],
            [
                'type' => 'link',
                'name' => ' Advance Payments',
                'icon' => 'fa fa-credit-card',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', App\Models\Admin\Advance::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', App\Models\Admin\Advance::class),
                    ],
                ],
                'link' => adminRedirectRoute('advance'),
            ],
            [
                'type' => 'breaker',
                'name' => 'Jobs',
                'description' => 'Queue Jobs and Workers',
            ],
            [
                'type' => 'link',
                'name' => ' Failed Jobs',
                'icon' => 'fa fa-exclamation',
                'link' => route('failed_jobs'),
            ],
            [
                'type' => 'link',
                'name' => ' Processes',
                'icon' => 'fa fa-spin fa-spinner',
                'link' => route('processes'),
            ],
            [
                'type' => 'breaker',
                'name' => 'Dependencies',
                'description' => 'Marketing Dependencies',
            ],
            [
                'type' => 'menu',
                'name' => 'Groups',
                'icon' => 'fa fa-users',
                'is_active' => request()->routeIs('group*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', App\Models\Admin\Group::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', App\Models\Admin\Group::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('group', App\Models\Admin\Group::class)
            ],
            [
                'type' => 'menu',
                'name' => 'Client',
                'icon' => 'fa fa-male',
                'is_active' => request()->routeIs('client*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', App\Models\Admin\Client::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', App\Models\Admin\Client::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('client', App\Models\Admin\Client::class)
            ],
            [
                'type' => 'menu',
                'name' => 'Source',
                'icon' => 'fa fa-tint',
                'is_active' => request()->routeIs('source*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', App\Models\Admin\Source::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', App\Models\Admin\Source::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('source', App\Models\Admin\Source::class)
            ],
            [
                'type' => 'menu',
                'name' => 'Service',
                'icon' => 'fa fa-strikethrough',
                'is_active' => request()->routeIs('service*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', App\Models\Admin\Service::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', App\Models\Admin\Service::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('service', App\Models\Admin\Service::class)
            ],
            [
                'type' => 'menu',
                'name' => 'Department',
                'icon' => 'fa fa-building-o',
                'is_active' => request()->routeIs('department*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', App\Models\Admin\Department::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', App\Models\Admin\Department::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('department', App\Models\Admin\Department::class)
            ],
            [
                'type' => 'menu',
                'name' => 'Template',
                'icon' => 'fa fa-photo',
                'is_active' => request()->routeIs('template*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', App\Models\Admin\Template::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', App\Models\Admin\Template::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('template', App\Models\Admin\Template::class)
            ],
            [
                'type' => 'link',
                'name' => 'Logs',
                'icon' => 'fa fa-book',
                'link' => adminRedirectRoute('logs'),
            ],
            [
                'type' => 'breaker',
                'name' => 'Reports',
                'description' => 'View and Generate Reports',
            ],
            [
                'type' => 'menu',
                'name' => 'Reports',
                'icon' => 'fa fa-bar-chart-o',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->hasRole('admin'),
                    ],
                ],
                'children' => [
                    [
                        'type' => 'submenu',
                        'name' => 'Payment Reports',
                        'link' => route('payment_report'),
                    ],
                    [
                        'type' => 'submenu',
                        'name' => 'Project Reports',
                        'link' => route('project_report'),
                    ],
                    [
                        'type' => 'submenu',
                        'name' => 'Advance Reports',
                        'link' => route('advance_report'),
                    ],
                ]
            ],
            [
                'type' => 'breaker',
                'name' => 'DEV TOOLS',
                'description' => 'Development Environment',
            ],
            [
                'type' => 'menu',
                'name' => 'Builder',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => env('APP_ENV') == 'local'
                    ],
                ],
                'children' => [
                    [
                        'type' => 'submenu',
                        'name' => 'Form Builder 1',
                        'link' => 'http://admin.pixelstrap.com/cuba/theme/form-builder-1.html',
                    ],
                    [
                        'type' => 'submenu',
                        'name' => 'Form Builder 2',
                        'link' => 'http://admin.pixelstrap.com/cuba/theme/form-builder-2.html',
                    ],
                    [
                        'type' => 'submenu',
                        'name' => 'Page Builder',
                        'link' => 'http://admin.pixelstrap.com/cuba/theme/pagebuild.html',
                    ],
                    [
                        'type' => 'submenu',
                        'name' => 'Buttom Builder',
                        'link' => 'http://admin.pixelstrap.com/cuba/theme/button-builder.html',
                    ],
                ]
            ],
            [
                'type' => 'menu',
                'name' => 'Documentation',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => env('APP_ENV') == 'local'
                    ],
                ],
                'children' => [
                    [
                        'type' => 'submenu',
                        'name' => 'Frontend Docs',
                        'link' => 'https://docs.pixelstrap.com/cuba/all_in_one/document/index.html',
                    ],
                    [
                        'type' => 'submenu',
                        'name' => 'Adminetic Docs',
                        'link' => 'https://pratikdai404.gitbook.io/adminetic/',
                    ],
                ]
            ],
            [
                'type' => 'link',
                'name' => 'Github',
                'icon' => 'fa fa-github',
                'link' => 'https://github.com/pratiksh404/admineticl',
            ],
        ];
    }
}
