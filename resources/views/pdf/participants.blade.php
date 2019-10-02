<!DOCTYPE html>
<html>

<head>
    <title>{{ $event->title }}</title>
</head>

<body>
    @include('pdf.include.header')
    @include('pdf.include.footer')
    <main>
        @include('pdf.include.participants')
    </main>
</body>
</body>

</html>
@include('pdf.include.style')