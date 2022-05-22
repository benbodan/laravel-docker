<x-layout>
    <div class="container">
        <form method="get">
            <div class="row">
                <div class="col">
                    <label for="from">From Date:</label>
                    <input type="date" name="from_date" value="2020-01-01">

                    <label for="start">To Date:</label>
                    <input type="date" id="start" name="to_date" value="2020-03-02">

                    <button type="submit" class="btn btn-primary">Search</button>
                    <hr>
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Surname</th>
                        <th scope="col">Latest Payment</th>
                        <th scope="col">Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($clientsPayment as $client)
                        <tr>
                            <th scope="row">{{$client->id}}</th>
                            <td>{{$client->name}}</td>
                            <td>{{$client->surname}}</td>
                            <td>{{$client->amount ?? '-'}}</td>
                            <td>{{$client->created_at ?? '-'}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout>
