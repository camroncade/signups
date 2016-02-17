<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>{{ $signup->name }}</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ url('css/site.css') }}">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
    <body>
        <div class="container">
            <div class="header clearfix">
                <h3 class="text-muted">{{ $signup->name }}</h3>
            </div>

            @if( ! is_null($signup->description) )
            <div class="col-sm-12">
                <p style="font-size: 1.2em;">
                    {{ $signup->description }}
                </p> 
                <hr />
            </div>
            @endif

            <div class="col-sm-12 form-horizontal">
                @foreach($signup->groups as $group)
                    <h3 style="font-weight: 300;">{{ $group->title }}</h3>
                    @foreach($group->fields as $field)
                        <div class="form-group">
                            <label class="col-sm-3 control-label">{{ $field->name }}</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="{{ $field->id }}" value="{{ $field->value }}" />
                                @if ($field->description)
                                    <span class="help-block">{{ $field->description }}</span>
                                @endif
                            </div> 
                            <div class="hidden" style="position: absolute; right: 15px;">
                               <button id="{{ $field->id }}" class="btn btn-primary">Save</button> 
                            </div>
                        </div>
                    @endforeach
                    <hr />
                @endforeach
            </div>
        </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    </body>
<script>
$('input').keypress(function(input) {
   $('#' + input.currentTarget.name).parent().removeClass('hidden'); 
});
$('button').click(function(button) {
    $.ajax({
        url: '/fields/' + button.currentTarget.id,
        method: 'post',
        data: {
            id: button.currentTarget.id, 
            value: $('input[name='+button.currentTarget.id+']').val(),
            _token: "{{ csrf_token() }}",
        }
    });
    button.currentTarget.classList.add('hidden');
});
</script>
</html>
