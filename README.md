# UsersAdmin
<p align="center">
  <img src="https://img.shields.io/github/languages/count/NataliaSuarez/UsersAdmin" />
  <img src="https://img.shields.io/github/languages/top/NataliaSuarez/UsersAdmin?color=blueviolet" />
  <img src="https://img.shields.io/github/last-commit/NataliaSuarez/UsersAdmin" />
  <img src="https://img.shields.io/github/issues-raw/NataliaSuarez/UsersAdmin?color=orange" />
  <img src="https://img.shields.io/github/issues-pr-closed/NataliaSuarez/UsersAdmin?color=success" />
</p>

Short project with login and CRUD of users

<!-- [![Readme Card](https://github-readme-stats.vercel.app/api/pin/?username=NataliaSuarez&repo=UsersAdmin)](https://github.com/anuraghazra/github-readme-stats) -->

### Requirements

- php 7.3
- [composer](https://getcomposer.org/)
- mysql

  Optionally:

  - [docker](https://docs.docker.com/)

### Install

#### Run docker containers (Optionally)

You can run `docker-compose up` to up database with [phpmyadmin](https://docs.phpmyadmin.net/en/latest/setup.html) in localhost:8080.
Don't forget change host, port and database credencials accord with your environment.

#### Install dependencies:

This project works with Composer to manage libraries.
To install these dependencies see [docs](https://getcomposer.org/doc/01-basic-usage.md#installing-dependencies).

#### Run server

To start server in localhost run `php -S localhost:8000` or `php -S 0.0.0.0:8000` (with this option you can access from other devices in the same local internal).
