	 <!-- Modal -->
	 <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	     <div class="modal-dialog" role="document">
	         <div class="modal-content">
	             <form class="form-horizontal" method="POST" action="addEvent.php">

	                 <div class="modal-header">
	                     <h4 class="modal-title" id="myModalLabel">Add Schedule</h4>
	                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
	                             aria-hidden="true">&times;</span></button>

	                 </div>
	                 <div class="modal-body">

	                     <div class="form-group">
	                         <label for="title" class="col-sm-2 control-label">Activity:</label>
	                         <div class="col-sm-10">
	                             <!-- <input type="text" name="title" class="form-control" id="title" placeholder="Activity" autocomplete="off" style="height: 80px;" required=""> -->
	                             <input id="title" class="form-control" name="title" maxlength="300" value=""
	                                 required></input>
	                         </div>
	                     </div>



	                     <div class="form-group">
	                         <label for="color" class="col-sm-9 control-label">Type of Activiy:</label>
	                         <div class="col-sm-10">
	                             <select name="color" class="form-control" id="color" required="">
	                                 <option value="">Choose</option>
	                                 <!-- <option style="color:#0071c5;" value="#0071c5">&#9724; Dark blue</option>
                                <option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquoise</option> -->

	                                 <option style="color:#FF0000;" value="#FF0000">&#9724; URGENT MEETING</option>
	                                 <option style="color:#008000;" value="#008000">&#9724; PERSONAL SCHEDULE</option>
	                                 <option style="color:#FF8C00;" value="#FF8C00">&#9724; Executives Schedule</option>
	                                 <option style="color:#0071c5;" value="#0071c5">&#9724; ETC</option>




	                                 <!--<option style="color:#FF8C00;" value="#FF8C00">&#9724; ROOM C</option>
                                    <option style="color:#0071c5;" value="#0071c5">&#9724; ROOM D</option> -->

	                                 <!-- <option style="color:#FFD700;" value="#FFD700">&#9724; Yellow</option>

                                <option style="color:#000;" value="#000">&#9724; Black</option> -->

	                             </select>
	                         </div>
	                     </div>
	                     <div class="form-group">
	                         <label for="start" class="col-sm-9 control-label">Date and Time</label>
	                         <div class="col-sm-10">
	                             <input type="text" name="start" class="form-control" id="start">
	                         </div>
	                     </div>
	                     <div class="form-group">
	                         <label for="end" class="col-sm-9 control-label">End date</label>
	                         <div class="col-sm-10">
	                             <input type="text" name="end" class="form-control" id="end">
	                         </div>
	                     </div>

	                 </div>
	                 <div class="modal-footer">
	                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	                     <button type="submit" class="btn btn-success">Save changes</button>
	                 </div>
	             </form>
	         </div>
	     </div>
	 </div>



	 <!-- Modal -->
	 <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	     <div class="modal-dialog" role="document">
	         <div class="modal-content">
	             <form class="form-horizontal" method="POST" action="editEventTitle.php">
	                 <div class="modal-header">
	                     <h4 class="modal-title" id="myModalLabel">Edit Schedule</h4>
	                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
	                             aria-hidden="true">&times;</span></button>

	                 </div>
	                 <div class="modal-body">

	                     <div class="form-group">
	                         <label for="title" class="col-sm-10 control-label">Activity</label>
	                         <div class="col-sm-10">
	                             <!-- <input type="text" name="title" class="form-control" id="title" placeholder="Title"> -->
	                             <input id="title" class="form-control" name="title" maxlength="300" value=""
	                                 required></input>
	                         </div>
	                     </div>

	                     <div class="form-group">
	                         <label for="color" class="col-sm-10 control-label">ACTIVITY COLOR SCHEME</label>
	                         <div class="col-sm-10">
	                             <select name="color" class="form-control" id="color">
	                                 <option value="">Choose</option>
	                                 <option style="color:#FF0000;" value="#FF0000">&#9724; URGENT MEETING</option>
	                                 <option style="color:#008000;" value="#008000">&#9724; PERSONAL SCHEDULE</option>
	                                 <option style="color:#FF8C00;" value="#FF8C00">&#9724; Executives Schedule</option>
	                                 <option style="color:#0071c5;" value="#0071c5">&#9724;ETC</option>
	                             </select>
	                         </div>
	                     </div>
	                     <div class="form-group">
	                         <label for="start" class="col-sm-8 control-label">Date and Time</label>
	                         <div class="col-sm-10">
	                             <input type="text" name="start" class="form-control" id="start">
	                         </div>
	                     </div>
	                     <div class="form-group">
	                         <label for="end" class="col-sm-8 control-label">End date</label>
	                         <div class="col-sm-10">
	                             <input type="text" name="end" class="form-control" id="end">
	                         </div>
	                     </div>


	                     <div class="form-group">
	                         <div class="col-sm-offset-2 col-sm-10">
	                             <div class="checkbox">
	                                 <label class="text-danger"><input type="checkbox" name="delete"> Delete event</label>
	                             </div>
	                         </div>
	                     </div>

	                     <input type="hidden" name="id" class="form-control" id="id">


	                 </div>
	                 <div class="modal-footer">
	                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	                     <button type="submit" class="btn btn-success 	">Save changes</button>
	                 </div>
	             </form>
	         </div>
	     </div>
	 </div>
	 <!-- END Modal -->