@extends('app')

@section('title')
    Auftrag bearbeiten
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs check-active-links">
                <li><a href="{{ url('jobs/' . $job->id) }}">Auftrag anzeigen</a></li>
                <li><a href="{{ url('jobs/' . $job->id . '/edit') }}">Auftrag Bearbeiten</a></li>
            </ul>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12" id="item-add-table">
            <h3>
                {{ $job->name }}
                <p class="small">
                    Auftrag
                </p>
            </h3>
            <div class="row">
                <div class="col-sm-7">
                    <h4>Eigenschaften</h4>
                    <form class="form" action="{{ url('jobs/' . $job->id . '/edit') }}" method="post">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label for="name">Name:</label>
                                <input type="text" name="name" value="{{ $job->name }}" class="form-control" placeholder="Name" required="">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label for="is_rental">Kategorie:</label>
                                <select class="form-control" name="is_rental" required="">
                                    <option value="0" @if(!$job->is_rental)selected=""@endif>Auftrag</option>
                                    <option value="1" @if($job->is_rental)selected=""@endif>Verleih</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label for="leader">Zugeteilter Techniker:</label>
                                <select class="form-control" name="leader" required="">
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" @if($job->user->id == $user->id)selected=""@endif>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label for="recipent">Auftraggeber:</label>
                                <input type="text" name="recipent" value="{{ $job->recipent }}" class="form-control" placeholder="Name" required="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label for="time_start">Beginnt am:</label>
                                <input type="date" name="time_start" class="form-control" value="{{ date('Y-m-d', strtotime($job->time_start)) }}">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label for="time_end">Endet am:</label>
                                <input type="date" name="time_end" class="form-control" value="{{ date('Y-m-d', strtotime($job->time_end)) }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <label for="description">Beschreibung:</label>
                                <textarea name="description" class="form-control" placeholder="Beschreibung">{{ $job->description }}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <button type="submit" name="button" class="btn btn-primary">Auftrag speichern</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-sm-5">
                    <h4>
                        Genutzte Artikel:
                        <button type="button" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#item-modal">Hinzufügen</button>
                    </h4>
                        <p class="lead" v-if="used.length == 0">Keine Artikel in diesem Auftrag</p>
                        <table class="table" v-if="used.length > 0">
                            <thead>
                                <th>
                                    Name
                                </th>
                                <th>
                                    Anzahl
                                </th>
                                <th>
                                    Frei
                                </th>
                                <th>

                                </th>
                            </thead>
                            <tbody>
                                <template v-for="item in used">
                                    <tr>
                                        <td>
                                            @{{ item.$item.name }}
                                        </td>
                                        <td>
                                            <input type="number" v-model="item.use_count" min="1" :max="item.$item.free_count" style='width: 100%;'>
                                        </td>
                                        <td>
                                            @{{ item.$item.free_count }}
                                        </td>
                                        <td>
                                            <a href="#" @click="remove(item, $event)" class="btn btn-danger btn-sm pull-right">Entfernen</a>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                        <form class="form" action="{{ url('jobs/' . $job->id . '/items') }}" method="post" v-on:submit="onSubmit">
                            {{ csrf_field() }}
                            <input type="hidden" name="items">
                            <input type="hidden" name="job_id" value="{{ $job->id }}">
                            <button type="submit" class="btn btn-primary">Speichern</button>
                        </form>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="item-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Artikel zum Auftrag hinzufügen</h4>
                            </div>
                            <div class="modal-body">
                                @if (count($items) <= 0)
                                    <p class="lead">Keine Artikel im Inventar</p>
                                @else
                                    <table class="table">
                                        <thead>
                                            <th>
                                                ID
                                            </th>
                                            <th>
                                                Name
                                            </th>
                                            <th>
                                                Frei
                                            </th>
                                            <th>

                                            </th>
                                        </thead>
                                        <tbody>
                                            <template v-for="item in items">
                                                <tr v-if="item.free_count > 0 && !isUsed(item)">
                                                    <td>
                                                        @{{ item.id }}
                                                    </td>
                                                    <td>
                                                        @{{ item.name }}
                                                    </td>
                                                    <td>
                                                        @{{ item.free_count }} / @{{ item.total_count }}
                                                    </td>
                                                    <td>
                                                        <a href="#" @click="add(item, $event)" data-dismiss="modal" class="btn btn-primary btn-sm pull-right">Hinzufügen</a>
                                                    </td>
                                                </tr>
                                            </template>
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script type="text/javascript">
        var vue;
        $(document).ready(function () {
            var jobID = {{ $job->id }};
            var items = [
                @foreach($items as $item)
                    {
                        id: {{ $item->id }},
                        name: '{{ $item->name }}',
                        total_count: {{ $item->total_count }},
                        free_count: {{ $item->freeCount($job->time_start, $job->time_end) }},
                        type: {!! $item->type !!}
                    },
                @endforeach
            ];

            var getItems = function (id, use_count) {
                var item = null;
                $.each(items, function (index, value) {
                    if (value.id == id) {
                        item = value;
                        return false;
                    }
                });

                if (item != null)
                    item.free_count += use_count;

                return item;
            };

            var used = [
                @foreach($job->items as $item)
                    {
                        id: {{ $item->item_id }},
                        use_count: {{ $item->use_count }},
                        $item: getItems({{ $item->item_id }}, {{ $item->use_count }})
                    },
                @endforeach
            ];

            vue = new Vue({
                el: '#item-add-table',
                data: {
                    items: items,
                    used: used
                },
                computed: {
                    formUsed: function () {

                    }
                },
                methods: {
                    add: function (item, e) {
                        // Can't add item that doesnt have free items
                        if (item.free_count <= 0) {
                            return false;
                        }

                        // Cant add item thats already added
                        for (var i = 0; i < this.used.length; i++) {
                            if (this.used[i].id == item.id) {
                                return false;
                            }
                        }

                        this.used.push({
                            id: item.id,
                            use_count: 1,
                            $item: getItems(item.id, 0)
                        });

                        return false;
                    },

                    remove: function (item, e) {
                        var index = this.used.indexOf(item);
                        if (index != -1)
                            this.used.splice(index, 1);
                    },

                    onSubmit: function (e) {
                        for (var i = 0; i < this.used.length; i++) {
                            var use = this.used[i];
                            if (use.use_count > use.$item.free_count) {
                                e.preventDefault();
                                alert('Der Artikel "' + use.$item.name + '" hat nicht genug freie Artikel.');
                                return false;
                            }

                            if (use.use_count <= 0) {
                                e.preventDefault();
                                alert('Die gewollte Anzahl für den Artikel "' + use.$item.name + '" darf nicht 0 oder weniger betragen.');
                                return false;
                            }
                        }

                        var data = [];
                        for (var i = 0; i < this.used.length; i++) {
                            var use = this.used[i];
                            data.push({
                                item_id: use.id,
                                use_count: use.use_count
                            });
                        }

                        $(e.target).find('input[name=items]').val(JSON.stringify(data));
                    },

                    isUsed: function (item) {
                        for (var i = 0; i < this.used.length; i++) {
                            if (this.used[i].id == item.id)
                                return true;
                        }

                        return false;
                    }
                }
            });
        });

        // function postItems (items) {
        //     $.ajax({
        //         url: '',
        //         method: 'POST',
        //         data: {
        //             items: items
        //         }
        //     }).done(function () {
        //
        //     }).fail(function () {
        //
        //     });
        // }
    </script>
@endsection
