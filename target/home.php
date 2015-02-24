<?php
include('declare.php');

$title = "Attack pattern prototypes: index";
include('inc/header.php');
?>
<h1>Attack pattern prototypes</h1>
<p class="instructions">
This page is the starting point for exploring working implementations of
the prototypical attack architectures described in the paper ``Protection
Models for Security-Policy Enforcement'' by Rich Joiner, Tom Reps, and
Somesh Jha.
</p>
<p class="instructions">
You are currently visiting the target server, a benign website
operating legitimately. The pages below walk through various attack
patterns, which may involve redirection to a ``malicious'' server hosted
on another domain.
</p>
<h3>Attack patterns</h3>
<ul>
<li>Stored XSS | <a href="stored/start">start</a></li>
<li>Reflected XSS | <a href="reflected/start">start</a></li>
<li>DOM-based XSS | <a href="dombased/start">start</a></li>
<li>Resource scanner | <a href="scanning/start">start</a></li>
<li>Trojan | <a href="trojan/start">start</a></li>
<li>Phishing | <a href="phishing/start">start</a></li>
</ul>
<?
include('inc/footer.php');
?>
