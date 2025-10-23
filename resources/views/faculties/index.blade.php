<!DOCTYPE html>
<html>
<head>
    <title>Facultades</title>
</head>
<body>
    <h1>Facultades</h1>
    <ul>
        @foreach($faculties as $faculty)
            <li>
                {{ $faculty->name_fac }} ({{ $faculty->acronym_fac }})
                <ul>
                    @foreach($faculty->careers as $career)
                        <li>{{ $career->name_career }}
                            <ul>
                                @foreach($career->teachers as $teacher)
                                    <li>{{ $teacher->name_teacher }}</li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                </ul>
            </li>
        @endforeach
    </ul>
</body>
</html>
