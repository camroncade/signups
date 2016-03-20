<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <meta name="signup-id" content="{{ $signup->id }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Edit Signup Form - {{ $signup->name }}</title>
        <link href='https://fonts.googleapis.com/css?family=Lato:400,300,700,100' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="/css/main.css" type="text/css" media="screen" title="no title" charset="utf-8">
    </head>
    <body>
        <div class="container">
            <input type="text" value="{{ $signup->name }}" placeholder="Form Name"  id="form-name" />

           @foreach($signup->groups->sortBy('sort_index') as $group) 
            <div class="group" group-id="{{ $group->id }}">
                <input type="text" value="{{ $group->name }}" group-id="{{ $group->id }}" placeholder="Group name" class="group-name">
                @foreach($group->fields->sortBy('sort_index') as $field)
                <div class="input" field-id="{{ $field->id }}">
                    <div class="name">
                        <input type="text" field-id="{{ $field->id }}" class="field-name" value="{{ $field->name }}" placeholder="name" />
                    </div>
                    <div class="description">
                        <textarea name="description" field-id="{{ $field->id }}" class="field-description" placeholder="Description (optional)">{{ $field->description }}</textarea>
                    </div>

                    <div class="form-options">
                        <div class="form-delete">
                            <i class="fa fa-trash-o"></i>
                        </div>
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

                <div class="group-delete">
                    <i class="fa fa-trash-o"></i>
                </div>
            </div>
            @endforeach

            <button class="add-new-group">Add new group</button>

        </div>
    </body>
    <script data-main="/js/build" src="https://cdnjs.cloudflare.com/ajax/libs/require.js/2.1.22/require.min.js" type="text/javascript" charset="utf-8"></script>
</html>
