<script>
    $(function(){
        $(document).ready(function(){
               $('#project_calendar').fullCalendar({
            // put your options and callbacks here
            events : [
                @foreach($projects as $project)
                {
                    title : '{{ $project->name ?? ('#'.$project->code) }}',
                    start : '{{ $project->project_startdate }}',
                    end : '{{ $project->project_deadline }}',
                    url : '{{ adminShowRoute('project', $project->id) }}',
                    color: '{{ $project->color }}'
                },
                @endforeach
            ]
        })
        });
    });
</script>