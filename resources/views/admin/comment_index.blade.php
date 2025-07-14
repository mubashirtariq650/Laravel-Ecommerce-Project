<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    @include('admin.css')
    <style>
        h2 {
            text-align: center;
            margin: 30px 0;
            color: white;
          
        }

        table {
            width: 100%;
            max-width: 1100px;
            margin: auto;
            border-collapse: collapse;
         
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            border-radius: 10px;
            overflow: hidden;
        }

        thead {
            background-color: #2c3e50;
            color: #fff;
        }

        th, td {
            padding: 14px 20px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        tbody tr:nth-child(even) {
        }

        .reply {
            font-style: italic;
            border-left: 4px solid #3498db;
        }

        @media (max-width: 768px) {
            table, thead, tbody, th, td, tr {
                display: block;
            }

            thead {
                display: none;
            }

            tr {
                margin-bottom: 15px;
                background: #fff;
                box-shadow: 0 2px 10px rgba(0,0,0,0.05);
                border-radius: 8px;
                padding: 10px;
            }

            td {
                display: flex;
                justify-content: space-between;
                padding: 10px 15px;
                border: none;
                border-bottom: 1px solid #ddd;
            }

            td::before {
                content: attr(data-label);
                font-weight: bold;
                color: #555;
            }

            .reply {
                border-left: 4px solid #3498db;
            }
        }
    </style>
</head>
<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar')
        <!-- partial -->
        @include('admin.header')

        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <h2>All Comments & Replies</h2>

                <table>
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Comment</th>
                            <th>Is Reply?</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($comments as $comment)
                            <tr>
                                <td data-label="User">{{ $comment->user->name }}</td>
                                <td data-label="Comment">{{ $comment->body }}</td>
                                <td data-label="Is Reply?">No</td>
                                <td data-label="Date">{{ $comment->created_at->format('Y-m-d H:i') }}</td>
                            </tr>

                            @foreach($comment->replies as $reply)
                                <tr class="reply">
                                    <td data-label="User">{{ $reply->user->name }}</td>
                                    <td data-label="Comment">{{ $reply->body }}</td>
                                    <td data-label="Is Reply?">Yes (Reply to ID: {{ $comment->id }})</td>
                                    <td data-label="Date">{{ $reply->created_at->format('Y-m-d H:i') }}</td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- plugins:js -->
    @include('admin.script')
</body>
</html>
