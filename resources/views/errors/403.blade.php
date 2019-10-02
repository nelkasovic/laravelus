@extends('layouts.error')

@section('code', $exception->getCode())

@section('title', 'Error')

@section('message', $exception->getMessage())
