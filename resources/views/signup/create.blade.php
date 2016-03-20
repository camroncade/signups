<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <title>Create Signup Form</title>
        <link rel="stylesheet" href="/css/main.css" type="text/css" media="screen" title="no title" charset="utf-8">
    </head>
    <body>
        <div class="page-wrapper">
            <div class="create-signup-form">
                <h2>Create form</h2>
                <div class="form">
                    <form action="/new" method="POST">

                        {{ csrf_field() }}                    

                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" placeholder="Form name" name="name" />
                        </div>

                        <div class="form-group">
                            <label>Url slug</label>
                            <input type="text" placeholder="Url slug" name="slug" />
                        </div>

                        <div class="form-group">
                            <button type="submit">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
