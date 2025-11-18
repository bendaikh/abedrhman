# Abedrhman - Laravel with Vue.js and Blade

A Laravel application demonstrating the integration of Blade templates and Vue.js components.

## Features

- ✅ Laravel 12 with Blade templates
- ✅ Vue.js 3 integration
- ✅ Vite for asset bundling
- ✅ Tailwind CSS for styling
- ✅ Example Vue components (Counter, Todo List, Example Component)
- ✅ Example Blade templates with server-side rendering

## Installation

1. Navigate to the project directory:
```bash
cd bouyahya
```

2. Install PHP dependencies:
```bash
composer install
```

3. Install Node.js dependencies:
```bash
npm install
```

4. Copy the environment file:
```bash
cp .env.example .env
```

5. Generate application key:
```bash
php artisan key:generate
```

6. Run database migrations:
```bash
php artisan migrate
```

## Development

### Start the Laravel development server:
```bash
php artisan serve
```

### Start Vite for asset compilation (in a separate terminal):
```bash
npm run dev
```

The application will be available at `http://localhost:8000`

## Routes

- `/` - Home page with all components
- `/blade-example` - Blade template examples
- `/vue-example` - Vue.js component examples

## Project Structure

```
bouyahya/
├── resources/
│   ├── js/
│   │   ├── app.js              # Main JavaScript entry point
│   │   └── components/         # Vue components
│   │       ├── ExampleComponent.vue
│   │       ├── CounterComponent.vue
│   │       └── TodoListComponent.vue
│   └── views/                  # Blade templates
│       ├── home.blade.php
│       ├── blade-example.blade.php
│       └── vue-example.blade.php
├── routes/
│   └── web.php                 # Application routes
└── vite.config.js              # Vite configuration
```

## Vue Components

### ExampleComponent
A simple component displaying the current time that updates every second.

### CounterComponent
An interactive counter with increment and decrement buttons.

### TodoListComponent
A full-featured todo list with add, complete, and delete functionality.

## Building for Production

To build assets for production:

```bash
npm run build
```

## Technologies Used

- **Laravel 12** - PHP framework
- **Vue.js 3** - Progressive JavaScript framework
- **Vite** - Next-generation frontend build tool
- **Tailwind CSS** - Utility-first CSS framework
- **Blade** - Laravel's templating engine

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

