<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>{title}</title>
<link rel="stylesheet" href="<?php echo base_url('assets/css/fontawesome.min.css') ?>" type="text/css">
<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" type="text/css">
<link rel="stylesheet" href="<?php echo base_url('assets/css/sweetalert2.min.css') ?>" type="text/css">
<link rel="stylesheet" href="<?php echo base_url('assets/css/ctfigniter.css') ?>" type="text/css">
</head>
<body>
<div class="container mt-4 mb-4">
<div class="col-md-7 offset-center">
<header class="text-center mb-4">
<h1 class="title">{web_title}</h1>
<p>{web_desc}</p>
<ul class="nav justify-content-center">
<li class="nav-item">
<a class="nav-link" href="<?php echo base_url() ?>">Home</a>
</li>
<li class="nav-item">
<a class="nav-link" href="<?php echo base_url('admin/statistics') ?>">Statistics</a>
</li>
<li class="nav-item">
<a class="nav-link" href="<?php echo base_url('admin/challenges') ?>">Challenges</a>
</li>
<li class="nav-item">
<a class="nav-link" href="<?php echo base_url('admin/categories') ?>">Categories</a>
</li>
<li class="nav-item">
<a class="nav-link" href="<?php echo base_url('admin/users') ?>">Users</a>
</li>
<li class="nav-item">
<a class="nav-link" href="<?php echo base_url('admin/settings') ?>">Settings</a>
</li>
</ul>
</header>
