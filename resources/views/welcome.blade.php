<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Dates with timezone</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.0/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.13/moment-timezone-with-data.js"></script>

    </head>
    <body>
        
        <div class="row">
            <div class="col-md-6">
                <h1>Add task</h1>
                <form action="/save" method="POST" class="form-horizontal">
                    {{ csrf_field() }}
                    <input type="hidden" name="timezone" id="timezone">

                    <div class="form-group">
                        <label for="task" class="col-sm-3 control-label">Task</label>

                        <div class="col-sm-6">
                            <input type="text" name="title" id="task" class="form-control">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="tz" class="col-sm-3 control-label">Timezone of task creator</label>

                        <div class="col-sm-6">
                            <select name="tz" id="tz" class="form-control">
                                <option value="Asia/Singapore">Asia/Singapore</option>
                                <option value="Asia/Karachi">Asia/Karachi</option>
                                <option value="Asia/Yerevan">Asia/Yerevan</option>
                                <option value="Asia/Kolkata">Asia/Kolkata</option>
                                <option value="Europe/Amsterdam">Europe/Amsterdam</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-6">
                            <button type="submit" class="btn btn-default">
                                <i class="fa fa-plus"></i> Add Task
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <h1>List the tasks </h1> (your timezone is <b>{{ session('timezone') }}</b>)
                <table class="table">
                    <thead>
                        <th>Title</th>
                        <th>Creator local time</th>
                        <th>Viewer local time</th>
                    </thead>
                    <tbody>
                        @foreach($tasks as $task)
                            <tr>
                                <td>{{ $task->title }}</td>
                                <td>{{ $task->local_time }}</td>
                                <td>{{ $task->created_at->timezone(session('timezone')) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        
        <script>

            $(document).ready(function(){
                timezone = moment.tz.guess();
                $('#timezone').val(timezone);
            });

        </script>

    </body>
</html>
