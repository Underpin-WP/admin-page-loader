# Underpin Admin Page Loader

Loader That assists with adding admin pages to a WordPress website.

## Installation

### Using Composer

`composer require underpin/admin-page-loader`

### Manually

This plugin uses a built-in autoloader, so as long as it is required _before_
Underpin, it should work as-expected.

`require_once(__DIR__ . '/underpin-admin-pages/admin-pages.php');`

## Setup

1. Install Underpin. See [Underpin Docs](https://www.github.com/underpin-wp/underpin)
1. Register new admin Pages as-needed.

## Basic Example

A very basic example could look something like this. This example would display a single text field on a settings page,
and handle field saving using Underpin's fields API.

```php
// Register the option to use on the settings page. See Underpin_Options\Abstracts\Option
underpin()->options()->add( 'example_admin_options', [
	'key'           => 'example_option', // required
	'default_value' => [
		'test_setting' => 'Hello world',
	],
	'name'          => 'Example Admin Page',
	'description'   => 'Settings manged by Example Admin Page',
] );

// Register the admin page
underpin()->admin_pages()->add( 'example-admin-page', [
	'page_title' => underpin()->__( 'Example Admin Page' ),
	'menu_title' => underpin()->__( 'Example' ),
	'capability' => 'administrator',
	'menu_slug'  => 'example-admin-page',
	'icon'       => 'dashicons-admin-site-alt',
	'position'   => 5,
	'sections'   => [
		[
			'id'          => 'primary-section',
			'name'        => underpin()->__( 'Primary Section' ),
			'options_key' => 'example_admin_options',
			'fields'      => [
				'test_setting' => [
					'class' => 'Underpin\Factories\Settings_Fields\Text',
					'args'  => [ underpin()->options()->pluck( 'example_admin_options', 'test_setting' ), [
						'name'        => 'test_setting',
						'description' => underpin()->__( 'Optional. Specify the person to say hello to. Default "world".' ),
						'label'       => underpin()->__( 'Name' ),
					] ],
				],
			],
		],
	],
] );

```

## Multiple Sections

The admin screen is broken into sections. This makes it possible to quickly change the layout of the page into various
display types, such as a tabular layout. This example would display all of the sections on a single page.

```php

// Register the option to use on the settings page. See Underpin_Options\Abstracts\Option
underpin()->options()->add( 'example_admin_options', [
	'key'           => 'example_option', // required
	'default_value' => [
		'test_setting'    => 'Hello world',
		'another_setting' => 'Second tab setting value',
	],
	'name'          => 'Example Admin Page',
	'description'   => 'Settings manged by Example Admin Page',
] );

// Register the admin page
underpin()->admin_pages()->add( 'example-admin-page', [
	'page_title' => underpin()->__( 'Example Admin Page' ),
	'menu_title' => underpin()->__( 'Example' ),
	'capability' => 'administrator',
	'menu_slug'  => 'example-admin-page',
	'icon'       => 'dashicons-admin-site-alt',
	'position'   => 5,
	'sections'   => [
		[
			'id'          => 'primary-section',
			'name'        => underpin()->__( 'Primary Section' ),
			'options_key' => 'example_admin_options',
			'fields'      => [
				'test_setting' => [
					'class' => 'Underpin\Factories\Settings_Fields\Text',
					'args'  => [ underpin()->options()->pluck( 'example_admin_options', 'test_setting' ), [
						'name'        => 'test_setting',
						'description' => underpin()->__( 'This is a description of this setting' ),
						'label'       => underpin()->__( 'Setting Name' ),
					] ],
				],
			],
		],
		[
			'id'          => 'secondary-section',
			'name'        => underpin()->__( 'Secondary Section' ),
			'options_key' => 'example_admin_options',
			'fields'      => [
				'test_setting' => [
					'class' => 'Underpin\Factories\Settings_Fields\Text',
					'args'  => [ underpin()->options()->pluck( 'example_admin_options', 'another_setting' ), [
						'name'        => 'another_setting',
						'description' => underpin()->__( 'This is a description of this setting' ),
						'label'       => underpin()->__( 'Secondary Setting Name' ),
					] ],
				],
			],
		],
	],
] );
```

## Sections as Tabs

To change the display to use tabs, simply set the `type` argument to `tabs`.

```php

// Register the option to use on the settings page. See Underpin_Options\Abstracts\Option
underpin()->options()->add( 'example_admin_options', [
	'key'           => 'example_option', // required
	'default_value' => [
		'test_setting'    => 'Hello world',
		'another_setting' => 'Second tab setting value',
	],
	'name'          => 'Example Admin Page',
	'description'   => 'Settings manged by Example Admin Page',
] );

// Register the admin page
underpin()->admin_pages()->add( 'example-admin-page', [
	'page_title' => underpin()->__( 'Example Admin Page' ),
	'menu_title' => underpin()->__( 'Example' ),
	'capability' => 'administrator',
	'menu_slug'  => 'example-admin-page',
	'layout'     => 'tabs',
	'icon'       => 'dashicons-admin-site-alt',
	'position'   => 5,
	'sections'   => [
		[
			'id'          => 'primary-section',
			'name'        => underpin()->__( 'Primary Section' ),
			'options_key' => 'example_admin_options',
			'fields'      => [
				'test_setting' => [
					'class' => 'Underpin\Factories\Settings_Fields\Text',
					'args'  => [ underpin()->options()->pluck( 'example_admin_options', 'test_setting' ), [
						'name'        => 'test_setting',
						'description' => underpin()->__( 'This is a description of this setting' ),
						'label'       => underpin()->__( 'Setting Name' ),
					] ],
				],
			],
		],
		[
			'id'          => 'secondary-section',
			'name'        => underpin()->__( 'Secondary Section' ),
			'options_key' => 'example_admin_options',
			'fields'      => [
				'test_setting' => [
					'class' => 'Underpin\Factories\Settings_Fields\Text',
					'args'  => [ underpin()->options()->pluck( 'example_admin_options', 'another_setting' ), [
						'name'        => 'another_setting',
						'description' => underpin()->__( 'This is a description of this setting' ),
						'label'       => underpin()->__( 'Secondary Setting Name' ),
					] ],
				],
			],
		],
	],
] );
```

## Customizing Templates

By default, layouts are intentionally built to match WordPress. The intent is to provide a fast way to build Admin pages,
something that is typically a time-consuming task. There are many ways to extend how this page behaves, however.

### Option 1: Create Custom Settings Fields

All of the field rendering happens inside `Setting_Field::place`. In-other words, if you create a custom Setting Field,
it is possible to create a custom template for a field, and customize how that field behaves when it is saved.

### Option 2: Extend Admin_Page to include custom layouts

Another option is to extend the relevant functions in `Admin_Page` with your own behavior.
By doing so, you will be able to create your own template files that can be used instead of the defaults.

It's not shown here, but you could also extend pretty much everything, including how options are saved, and where things get
saved.

```php
class Custom_Page extends \Underpin_Admin_Pages\Factories\Admin_Page_Instance{
  
  
	/**
	 * Fetches the valid templates and their visibility.
	 *
	 * override_visibility can be either "theme", "plugin", "public" or "private".
	 *  theme   - sets the template to only be override-able by a parent, or child theme.
	 *  plugin  - sets the template to only be override-able by another plugin.
	 *  public  - sets the template to be override-able anywhere.
	 *  private - sets the template to be non override-able.
	 *
	 * @since 1.0.0
	 *
	 * @return array of template properties keyed by the template name
	 */
	public function get_templates() {
	    if( 'custom-layout' === $this->layout ){
	      return [
	        'admin' => [ // This should match your entry file name for this template.
	           'override_visibility' => 'private' // Or whatever.
            ]
          ];
	    }
	    
	    // Fallback to default.
	    return parent::get_templates();
	}

	/**
	 * Fetches the template group name.
	 *
	 * @since 1.0.0
	 *
	 * @return string The template group name
	 */
	protected function get_template_group() {
	    if('custom-layout' === $this->layout){
	      return 'admin'; // Or whatever you want your subdirectory to be.
	    }
	    
	    // Fallback to default
		return parent::get_template_group();
	}


	/**
	 * @inheritDoc
	 */
	protected function get_template_root_path() {
	    if('custom-layout' === $this->layout){
	      return 'custom/root/path';
	    }
	    
	    // Fallback to default
		return parent::get_template_root_path();
	}

}
```

You could then use this factory just like you would normally, only now you must specify the class to use instead of the default.

```php

// Register the admin page
underpin()->admin_pages()->add( 'example-admin-page', [
	'class' => 'Custom_Page', // Name of the class to use
	'args'  => [ // Arguments use to set up this instance.
		'page_title' => underpin()->__( 'Example Admin Page' ),
		'menu_title' => underpin()->__( 'Example' ),
		'capability' => 'administrator',
		'menu_slug'  => 'example-admin-page',
		'layout'     => 'tabs',
		'icon'       => 'dashicons-admin-site-alt',
		'position'   => 5,
		'sections'   => [
			[
				'id'          => 'primary-section',
				'name'        => underpin()->__( 'Primary Section' ),
				'options_key' => 'example_admin_options',
				'fields'      => [
					'test_setting' => [
						'class' => 'Underpin\Factories\Settings_Fields\Text',
						'args'  => [ underpin()->options()->pluck( 'example_admin_options', 'test_setting' ), [
							'name'        => 'test_setting',
							'description' => underpin()->__( 'This is a description of this setting' ),
							'label'       => underpin()->__( 'Setting Name' ),
						] ],
					],
				],
			],
			[
				'id'          => 'secondary-section',
				'name'        => underpin()->__( 'Secondary Section' ),
				'options_key' => 'example_admin_options',
				'fields'      => [
					'test_setting' => [
						'class' => 'Underpin\Factories\Settings_Fields\Text',
						'args'  => [ underpin()->options()->pluck( 'example_admin_options', 'another_setting' ), [
							'name'        => 'another_setting',
							'description' => underpin()->__( 'This is a description of this setting' ),
							'label'       => underpin()->__( 'Secondary Setting Name' ),
						] ],
					],
				],
			],
		],
	],
] );
```