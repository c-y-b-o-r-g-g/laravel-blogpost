<!DOCTYPE html>
<html>

<head>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @include('admin.css')

    <style type="text/css">
        .title_deg {
            font-size: 30px;
            font-weight: bold;
            color: white;
            pad: 30px;
            text-align: center;
        }


        .table_deg {
            border: 1px solid white;
            width: 80%;
            text-align: center;
            margin-left: 70px;
        }

        .th_deg {
            background-color: #00d9ff;
            color: white;
        }

        .img_deg {
            height: 100px;
            padding: 10px;
        }
    </style>
</head>

<body>
    @include('admin.header')
    <div class="d-flex align-items-stretch">
        <!-- Sidebar Navigation-->
        @include('admin.sidebar')
        <!-- Sidebar Navigation end-->


        <div class="page-content">

            @if(session()->has('message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ session()->get('message') }}
                </div>



            @endif

            <h1 class="title_deg">All Posts</h1>


            <table class="table_deg">


                <tr class="th_deg">
                    <th>Post Title</th>

                    <th>Description</th>

                    <th>Posted By</th>

                    <th>Post Status</th>

                    <th>User Type</th>

                    <th>Image</th>

                    <th>Delete</th>

                    <th>Edit</th>

                    <th>Status accept</th>

                    <th>Status reject</th>

                </tr>


                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->description }}</td>
                        <td>{{ $post->name }}</td>
                        <td>{{ $post->post_status }}</td>
                        <td>{{ $post->user_type }}</td>

                        <td>
                            <img class="img_deg" src="postimage/{{ $post->image }}" alt="">
                        </td>

                        <td>
                            <a href="{{url('delete_post', $post->id)}}" class = "btn btn-danger" onclick="confirmation(event)" >Delete</a>
                        </td>
                        {{-- <td>{{ $post->pos }}</td> --}}

                        <td>
                            <a href="{{url('edit_page', $post->id)}}" class="btn btn-success">Edit</a>
                        </td>

                        <td>
                            <a onclick="return confirm('Confirm to accept this post')" href="{{url('accept_post', $post->id)}}" class="btn btn-outline-secondary">Accept</a>
                        </td>

                        <td>
                            <a onclick="return confirm('Confirm to reject this post')" href="{{url('reject_post', $post->id)}}" class="btn btn-primary">Reject</a>
                        </td>
                    </tr>
                @endforeach



            </table>
        </div>

        @include('admin.footer')
    </div>
    </div>
    <!-- JavaScript files-->
    <script src="admincss/vendor/jquery/jquery.min.js"></script>
    <script src="admincss/vendor/popper.js/umd/popper.min.js"></script>
    <script src="admincss/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="admincss/vendor/jquery.cookie/jquery.cookie.js"></script>
    <script src="admincss/vendor/chart.js/Chart.min.js"></script>
    <script src="admincss/vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="admincss/js/charts-home.js"></script>
    <script src="admincss/js/front.js"></script>

    <script>type="text/javascript"

        function confirmation(event) {
            event.preventDefault();
            var url = event.currentTarget.getAttribute('href');
            console.log(url);
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this post!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willnotDelete) => {
                    if (willnotDelete) {
                        window.location.href = url;
                    } else {
                        swal("Your post is not deleted!");
                    }
                });
        }
    </script>


</body>

</html>
