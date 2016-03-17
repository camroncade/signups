<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <title>Edit Signup Form - {{ $signup->name }}</title>
        <link href='https://fonts.googleapis.com/css?family=Lato:400,300,700,100' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="/css/main.css" type="text/css" media="screen" title="no title" charset="utf-8">
    </head>
    <body>
        <div class="container">
            <h1>{{ $signup->name }}</h1>

           @foreach($signup->groups as $group) 
            <div class="group">
                <h2>{{ $group->title }}</h2>
                @foreach($group->fields as $field)
                <div class="input">
                    <div class="name">
                        {{ $field->name }}
                    </div>
                    <div class="description">
                        {{ isset($field->description) ? 'Click to enter a description' : $field->description }}
                    </div>
                    
                    <div class="form-sort">
                        <div class="move-up">
                            <i class="fa fa-arrow-up"></i>                      
                        </div>
                        <div class="move-down">
                            <i class="fa fa-arrow-down"></i>                      
                        </div>
                    </div>
                </div>
                @endforeach

                <button class="add-new-field">Add new field</button>

               <div class="group-sort">
                    <div class="move-up">
                        <i class="fa fa-arrow-up"></i>                      
                    </div>
                    <div class="move-down">
                        <i class="fa fa-arrow-down"></i>                      
                    </div>
               </div> 
            </div>
            @endforeach

            <button class="add-new-group">Add new group</button>

        </div>
    </body>
</html>