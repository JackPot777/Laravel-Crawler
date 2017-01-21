@extends('master.dashboard')
@section('title','Web Crawler Panel - Website - Full List')
@section('bodyContent')
<!-- page content -->
<div class="right_col" role="main">
    <div class="row">
        <div class="page-title">
            <div class="title_left">
                <h3>Url <small> create an new entry.</small></h3>
            </div>
        </div>
    </div>
    <div class="row">
        @if (count($sites) > 0)
        <form method="post" action="{{url('/objectives/url/create')}}" class="form-horizontal form-label-left input_mask">
        <div class="col-md-10 col-md-offset-1 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Step 1: Website Selction<small> select a website you want to crawl.</small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br>
                        {!! csrf_field() !!}
                        @if (count($errors))
                             @foreach($errors->all() as $error)
                             <div class="alert alert-danger" role="alert">{{ $error }}</div>
                             @endforeach
                        @endif
                        <div class="form-group" id="select_website" {!! old('site_id')!==null?'style="display:none"':'' !!}>
                          <label class="control-label col-md-2 col-sm-2 col-xs-12">Select Website</label>
                          <div class="col-md-10 col-sm-10 col-xs-12">
                          <select  onChange="getSite(this.value);" name="site_id" class="form-control">
                            <option>Choose Website</option>
                            @foreach ($sites as $site)
                                <option {{old('site_id')!==null&&old('site_id')==$site->id?'selected':''}} value="{{$site->id}}">{{'#' . $site->id . ' ' .$site->name}}</option>
                            @endforeach
                          </select>
                          </div>
                        </div>
                        <div id="website_info" {!! old('site_id')!==null?'style="display:block"':'style="display:none"' !!}>
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12">Name</label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    <input type="text" id="site_name" name="site_name" readonly="readonly" class="form-control" value="{{ old('site_name')  }}" placeholder="Source Website Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12">Root Url</label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    <input type="text" id="site_root_url" name="site_root_url" readonly="readonly" class="form-control" value="{{ old('site_root_url')  }}" placeholder="http://www.google.com">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12">Description</label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    <input type="text" id="site_desc" name="site_desc" readonly="readonly" class="form-control" value="{{ old('site_desc') }}" placeholder="Website description">
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                    <button type="button" {!! old('site_id')!==null?'style="display:none"':'' !!} onclick="$('#select_website').hide();$(this).hide();$('#url_builder').show();" class="btn btn-success pull-right">Confirm</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="url_builder" class="col-md-10 col-md-offset-1 col-xs-12" {!! old('site_id')!==null?'style="display:block"':'style="display:none"' !!}>
              <div class="x_panel">
                <div class="x_title">
                  <h2>Step 2: Url Entry<small> Fillin url name and setup pattern.</small></h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <br>
                    <div class="form-group">
                      <label class="control-label col-md-2 col-sm-2 col-xs-12">Name</label>
                      <div class="col-md-10 col-sm-10 col-xs-12">
                        <input type="text" class="form-control" name="name" id="text_urlName" value="{{ old('name') }}" placeholder="Url Name">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-2 col-sm-2 col-xs-12">Url</label>
                      <div class="col-md-10 col-sm-10 col-xs-12">
                        <div class="input-group">
                            <input type="text" name="original_url" id="original_url" value="{{old('orginal_url')}}" class="form-control" placeholder="http://www.laravel.com/docs/5.1">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-success" id="btn_confirm" onclick="confirmUrl();">Confirm</button>
                            </span>
                        </div>
                      </div>
                    </div>
                    <div id="param_settings" class="form-group" {!! old('type')=='Simple_Custom'?'style="display:block"':'style="display:none"' !!}>
                      <label class="control-label col-md-2 col-sm-2 col-xs-12">Parameter Settings</label>
                      <div class="col-md-10 col-sm-10 col-xs-12">
<div id="custom_url_settings">
</div>
                      </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group" id="btn_submit" style="display:none">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <button type="submit" class="btn btn-success pull-right">Submit</button>
                        </div>
                    </div>
                </div>
              </div>
            </div>
        </form>
        @else
            <div class="row">
                <div class="col-md-12 col-xs-12 col-sm-12">
                    <div class="alert alert-success" role="alert">Please create an website record first.</div>
                </div>
            </div>
        @endif
        <br>
    </div>
</div>
<!-- page content -->
@stop

@section('customScript')
<script>
    function confirmUrl()
    {
        if ($('#btn_confirm').hasClass('btn-success'))
        {
            $('#original_url').prop('readonly',true);
            $('#text_urlName').prop('readonly',true);
            $('#btn_confirm').removeClass('btn-success').addClass('btn-danger').text('Cancel');
            $('#btn_submit').show();
            genForm();
        }else{
            $('#original_url').prop('readonly',false);
            $('#text_urlName').prop('readonly',false);
            $('#btn_confirm').removeClass('btn-danger').addClass('btn-success').text('Confirm');
            $('#custom_url_settings').empty();
            $('#param_settings').hide();
            $('#btn_submit').hide();
        }
    }

    function genForm()
    {
        $('#custom_url_settings').empty();
        $('#original_url').val((''+$('#original_url').val()).toLowerCase());
        var url = $('#original_url').val();
        var regExp = /@param[0-9]+/g;
        var matches = url.match(regExp);
        matches = uniq(matches);
        if (matches.length>0){$('#param_settings').show();}
        for (var i=0;i<matches.length;i++)
        {
            var name= matches[i].replace('@','');
            var elm = '<div class="row"><label class="col-md-2 col-md-2 col-xs-2 control-label">@' + name + '</label><div class ="col-md-5 col-md-5 col-xs-5"><div class="radio"><input class="form-group" name="'+ name +'[type]" type="radio" value="string" onclick="genParamType($(\'#'+name+'_field\'),'+"'"+name+"'"+',\'string\')"><label> String </label></div></div><div class ="col-md-5 col-md-5 col-xs-5"><div class="radio"><input class="form-group" name="' + name + '[type]" type="radio" value="number" onclick="genParamType($(\'#'+name+'_field\'),'+"'"+name+"'"+',\'number\')"><label> Number </label></div></div></div><div id="'+name+'_field"></div>';
            $('#custom_url_settings').append(elm);
        }
    }
    function uniq(a)
    {
        var seen = {};
        return a.filter(function(item)
        {
            return seen.hasOwnProperty(item) ? false : (seen[item] = true);
        });
    }
    
    function genParamType(elm,name,type)
    {
        elm.empty();
        if (type == 'string')
        {
            var newElm = '<div class="row"><div class="form-group"><label class="col-xs-2 control-label">Combination</label><div class="col-xs-10"><input class="form-control form-combination" name="' + name + '[combination]" type="text"></div></div></div>';
            elm.append(newElm);
        }else if(type == 'number')
        {
            var newElm = '<div class="row"><div class="form-group"><label class="col-xs-2 control-label">Start Number</label><div class="col-xs-4"><input class="form-control" name="' + name + '[start]" type="number"></div><label class="col-xs-2 control-label">End Number</label><div class="col-xs-4"><input class="form-control" name="' + name  + '[end]" type="number"></div></div></div>';
            elm.append(newElm);
        }
        $('.form-combination').tagsInput({
            'width':'auto',
           'interactive':true,
           'defaultText':'add a combination',
           'delimiter': [',',';'],
           'removeWithBackspace' : true,
           'minChars' : 0,
           'placeholderColor' : '#666666'
        });
    }
</script>
@stop
