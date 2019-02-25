<?php

class Config {

  const APP_NAME = 'Dragon';
  const APP_KEY = 'base64:F0ddrr8CfDHB14ThDFouY7UFRlJSd3vwPY8dLn0Llao=';
  const APP_DEBUG = false;
  const APP_URL = 'http://azaruniv-training.ud';

  const DB_CONNECTION = 'mysql';
  const DB_HOST = '127.0.0.1';
  const DB_PORT = '3306';
  const DB_DATABASE = 'dragon';
  const DB_USERNAME = 'root';
  const DB_PASSWORD = '';

  const SESSION_KEY = 'id';
  const SESSION_LIFETIME = '120';
  const JWT = false;

  const MAIL_DRIVER = 'smtp';
  const MAIL_HOST = 'smtp.mailtrap.io';
  const MAIL_PORT = '2525';
  const MAIL_USERNAME = null;
  const MAIL_PASSWORD = null;
  const MAIL_ENCRYPTION = null;


}