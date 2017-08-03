                <div class="box-body">
                  <table id="example2" class="table table-bordered table-striped table-hover">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody class="wordspackdatatable">
                     @foreach($wordsdata as $wordsdatas)
                           <tr id="datapackword{{ @$wordsdatas['id']}}">
                          <td><input type="text" name="wordnewname" value="{{ @$wordsdatas['name']}}" readonly=""></td>
                          <td><a href="javascript:void(0);" data-wordpackid="{{ @$wordsdatas['word_pack_id']}}" data-name="{{ @$wordsdatas['name']}}" id="{{ @$wordsdatas['id']}}" class="editwordrow"><i class="fa fa-edit"></i></a> &nbsp;&nbsp;<a href="javascript:void(0);" id="{{ @$wordsdatas['id']}}" class="deletewordraw"><i class="fa fa-close"></i></a></td>
                         </tr>
                          @endforeach
                 </tbody>
                  </table>
                </div><!-- /.box-body -->

