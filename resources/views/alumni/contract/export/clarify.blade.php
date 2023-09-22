<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
    </style>
</head>

<body>
{!! Auth::user()->termAndConditions()->where('type', \App\Enums\TermConditionType::ClarificationText)->latest()->first()->term !!}
<p><b>Ad soyad:</b> {{ Auth::user()->name }}</p>
<p><b>Onay tarihi:</b> {{ Auth::user()->termAndConditions()->where('type', \App\Enums\TermConditionType::ClarificationText)->latest()->first()->pivot->created_at }}</p>
</body>
</html>
