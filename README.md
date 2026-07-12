# Personal Portfolio

A modern, highly performant personal portfolio built with Laravel, Inertia.js (React), and Tailwind CSS v4.

## Features

- **Inertia.js & React**: Seamless single-page application feel with server-side routing.
- **Tailwind CSS v4**: Modern, utility-first styling with high performance.
- **Lenis Smooth Scroll**: Elegant scrolling interactions.
- **AOS (Animate on Scroll)**: Smooth scroll animations.
- **High Security & Rate Limiting**: Pre-configured throttle limits to prevent abuse.

---

## Getting Started

### Prerequisites

- PHP >= 8.3
- Composer
- Node.js & npm
- Local web server (e.g., Laragon, Laravel Herd, or Artisan serve)

### Installation & Setup

1. **Clone the repository** (or navigate to the project directory).
2. **Run the setup script**:
   This custom script will install dependencies, set up environment files, generate keys, migrate the database, and build the assets:
   ```bash
   composer run setup
   ```
3. **Run the Development Server**:
   Start the concurrently managed development server (Artisan server, Vite, logs, and queue listener):
   ```bash
   npm run dev
   ```

---

## License

This project is open-sourced software.
