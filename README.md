# Setup

To set up this project locally, follow the steps below:

### Prerequisites

Make sure you have the following installed:

- [Node.js](https://nodejs.org/) (version x.x.x)
- [npm](https://www.npmjs.com/) (comes with Node.js)
- [Git](https://git-scm.com/)

### 1. Clone the Repository

First, clone the repository to your local machine:

```bash
git clone https://github.com/username/repo-name.git
cd repo-name
```

### 2. Install Dependencies

```bash
composer install
npm install
```

### 3. Set Up Environment Variables

```bash
cp .env.example .env
```
Edit your .env file based on the database you are using

### 4. Generate Application Key
```bash
php artisan key:generate
```

### 5. Set Up the Database

```bash
php artisan migrate
```

### 6. Start the Development Server

```bash
php artisan serve
npm run dev
```
