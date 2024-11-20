@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="header">
            <div>
                <h3>ADD PROJECT</h3>
            </div>
            <div>
                <a href="{{ route('projects.index') }}" class="btn btn-outline-dark">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 24 24">
                        <g fill="none" fill-rule="evenodd">
                            <path
                                d="M24 0v24H0V0zM12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.019-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z" />
                            <path fill="currentColor"
                                d="M2.614 5.426A1.5 1.5 0 0 1 4 4.5h10a7.5 7.5 0 1 1 0 15H5a1.5 1.5 0 0 1 0-3h9a4.5 4.5 0 1 0 0-9H7.621l.94.94a1.5 1.5 0 0 1-2.122 2.12l-3.5-3.5a1.5 1.5 0 0 1-.325-1.634" />
                        </g>
                    </svg>
                    Back</a>
            </div>
        </div>

        <div>
            @if ($errors->any())
                <div class="mx-4">
                    @foreach ($errors->all() as $error)
                    <h5 class="fw-bold text-danger">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 24 24"><path fill="currentColor" d="M12 20a8 8 0 1 0 0-16a8 8 0 0 0 0 16m0 2C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10s-4.477 10-10 10m-1-6h2v2h-2zm0-10h2v8h-2z"/></svg>{{ $error }}</h5>
                    @endforeach
                </div>
            @endif
            <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
                @method('post')
                @csrf
                <div class="mb-4">
                    <label for="" class="form-label fw-bold">Project name</label>
                    <input type="text" class="form-control" value="{{old('project_name')}}" name="project_name">
                </div>
                <div class="mb-4">
                    <label for="" class="form-label fw-bold">Description</label>
                    <textarea class="form-control" name="description" rows="3">{{old('description')}}</textarea>
                </div>
                <div class="mb-4">
                    <label for="" class="form-label fw-bold">Project owner (Office / Department)</label>
                    <select name="office_id" class="form-control">

                    <option value="">Select office/department</option>
                    @foreach ($offices as $office)
                        <option value="{{$office->id}}" {{old('office_id') == $office->id ? 'selected' : ''}}>
                            {{$office->office_name}}
                        </option>
                    @endforeach
                </select>

                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold">Developer name</label>
                    <select name="user_id" class="form-control">
                        <option value="">Select developer</option>
                        @foreach ($users as $user)
                            <option value={{ $user->id }} {{old('user_id') == $user->id ? 'selected' : ''}}>
                                {{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="" class="form-label fw-bold">Tech Stack</label>
                    <textarea class="form-control" name="tech_stack" rows="3">{{old('tech_stack')}}</textarea>
                </div>
                <div class="mb-4">
                    <label for="" class="form-label fw-bold">Start SAD date</label>
                    <input type="date" class="form-control" value="{{old('start_sad')}}" name="start_sad">
                </div>
                <div class="mb-4">
                    <label for="" class="form-label fw-bold">Start development date</label>
                    <input type="date" class="form-control" value="{{old('start_dev')}}" name="start_dev">
                </div>
                <div class="mb-4">
                    <label for="" class="form-label fw-bold">Estimated deployment</label>
                    <input type="date" class="form-control" value="{{old('estimate_deployment')}}" name="estimate_deployment">
                </div>
                <div class="mb-4">
                    <label for="" class="form-label fw-bold">Deployment date</label>
                    <input type="date" class="form-control" value="{{old('deployment_date')}}" name="deployment_date">
                </div>
                <div class="mb-4">
                    <label for="" class="form-label fw-bold">Version</label>
                    <input type="text" class="form-control" value="{{old('version')}}" name="version">
                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold">Status</label>
                    <select id="inputStatus" class="form-control" name="status">
                        <option selected>Select status</option>
                        <option value="On-going development" {{old('status') == 'On-going development' ? 'selected' : ''}}>On-going development</option>
                        <option value="For deployment" {{old('status') == 'For deployment' ? 'selected' : ''}}>For deployment</option>
                        <option value="Deployed" {{old('status') == 'Deployed' ? 'selected' : ''}}>Deployed</option>
                        <option value="For update" {{old('status') == 'For update' ? 'selected' : ''}}>For update</option>
                        <option value="Cancelled" {{old('status') == 'Cancelled' ? 'selected' : ''}}>Cancelled</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="" class="form-label fw-bold">Public Link</label>
                    <input type="text" class="form-control" name="public_link" value="{{old('public_link')}}">
                </div>
                <div class="mb-4">
                    <label for="" class="form-label fw-bold">Admin Link</label>
                    <input type="text" class="form-control" name="admin_link" value="{{old('admin_link')}}">
                </div>
                <div class="mb-4">
                    <label class="form-label"><b>Attachment/s</b> (.docx/.doc) </label>
                    <input class="form-control" id="file-input" name="attachment[]" type="file" multiple>
                    <div id="file-list"></div>
                </div>
                <div class="mb-4">
                    <label for="" class="form-label fw-bold">Developer remarks</label>
                    <textarea class="form-control" name="dev_remarks" rows="3">{{old('dev_remarks')}}</textarea>
                </div>
                <div class="mb-4">
                    <label for="" class="form-label fw-bold">Google Analytics remarks</label>
                    <textarea class="form-control" name="google_remarks" rows="3">{{old('google_remarks')}}</textarea>
                </div>
                <div class="mb-4">
                    <label for="" class="form-label fw-bold">SEO comments</label>
                    <textarea class="form-control" name="seo_comments" rows="3">{{old('seo_comments')}}</textarea>
                </div>
                <div class="mb-4">
                    <label for="" class="form-label fw-bold">DPA Compliance remarks</label>
                    <textarea class="form-control" name="dpa_remarks" rows="3">{{old('dpa_remarks')}}</textarea>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-dark">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                            <path fill="white"
                                d="M12 4c4.411 0 8 3.589 8 8s-3.589 8-8 8s-8-3.589-8-8s3.589-8 8-8m0-2C6.477 2 2 6.477 2 12s4.477 10 10 10s10-4.477 10-10S17.523 2 12 2m5 9h-4V7h-2v4H7v2h4v4h2v-4h4z" />
                        </svg>
                        Add project</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('file-input').addEventListener('change', function() {
            var fileList = document.getElementById('file-list');
            fileList.innerHTML = '';
            for (var i = 0; i < this.files.length; i++) {
                fileList.innerHTML += this.files[i].name + '<br>';
            }
        });
    </script>

    <style>
        body {
            background-color: #f2f2f2;
        }

        .header {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            padding: 24px;
        }

        .header h3 {
            font-weight: 700;
            margin-top: 60px;
        }

        .btn {
            margin-top: 60px;
        }

        form {
            padding: 24px;
        }
    </style>
@endsection
