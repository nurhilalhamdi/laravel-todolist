<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{$title}}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container col-xl-10 col-xxl-8 px-4 py-5">
        @if(isset($error))
        <div class="row">
            <div class="alert alert-danger" role="alert">
                {{$error}}
            </div>
        </div>
        @endif
        <div class="row">
            <form method="post" action="/logout">
                <button class="w-15 btn btn-lg btn-danger" type="submit">Sign Out</button>
            </form>
        </div>
        <div class="row align-items-center g-lg-5 py-5">
            <div class="col-lg-7 text-center text-lg-start">
                <h1 class="display-4 fw-bold lh-1 mb-3">Todolist</h1>
                <p class="col-lg-10 fs-4">by <a target="_blank" href="https://www.programmerzamannow.com/">Programmer Zaman
                        Now</a></p>
            </div>
            <div class="col-md-10 mx-auto col-lg-5">
                <form class="p-4 p-md-5 border rounded-3 bg-light" method="post" action="/todolist">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="todo" placeholder="todo" id="todo">
                        <label for="todo">Todo</label>
                    </div>
                    <button class="w-100 btn btn-lg btn-primary" type="submit">Add Todo</button>
                </form>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>


                    <form class="p-4 p-md-5 border rounded-3 bg-light" method="post" action="/todolist">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="idtodo_edit" placeholder="todo" id="idtodo_edit">
                            <input type="text" class="form-control" name="todo_edit" placeholder="todo" id="todo_edit">
                            <label for="todo">Todo</label>
                        </div>
                    </form>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <form id="editForm" method="post">
                            @csrf
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row align-items-right g-lg-5 py-5">
            <div class="mx-auto">
                <form id="deleteForm" method="post" style="display: none"></form>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Todo</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($todolist as $todo)
                        <tr>
                            <th scope="row">{{$todo['id']}}</th>
                            <td>{{$todo['todo']}}</td>
                            <td class="text-end">
                                <div class="btn-group" role="group">
                                    <form action="/todolist/{{$todo['id']}}/delete" method="post">
                                        @csrf
                                        <button class="btn btn-danger" type="submit">Remove</button>
                                    </form>

                                    <button type="button" onclick="selectItem(this)" data-idtodo-id="{{ $todo['id'] }}" data-todo-id="{{ $todo['todo'] }}" class=" btn btn-secondary ms-2" data-bs-toggle="modal" data-bs-target="#exampleModal" id="edit">
                                        Edit
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


    </div>

    <script>
        function selectItem(x) {
            var idtodoId = x.getAttribute('data-idtodo-id');
            var todoId = x.getAttribute('data-todo-id');
            document.getElementById('idtodo_edit').value = idtodoId;
            document.getElementById('todo_edit').value = todoId;
            document.getElementById("editForm").action = "/todolist/" + idtodoId + "/edit";

        }
    </script>
</body>

</html>