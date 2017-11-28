import React, { Component } from 'react';
import {Link} from "react-router-dom"; 

class Modal extends Component{
render(){
	return(
		
			<div className="modal fade" id="exampleModal" tabIndex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            	<div className="modal-dialog" role="document">
	                <div className="modal-content">
	                    <div className="modal-header">
	                      <h5 className="modal-title" id="exampleModalLabel" style={{textAlign:'center'}}>Are you sure you want to delete the category</h5>
	                      <button type="button" className="close" data-dismiss="modal" aria-label="Close">
	                        <span aria-hidden="true">&times;</span>
	                      </button>
	                    </div>
	                    <div className="modal-footer">
	                      <input type='hidden' name='_method' value='DELETE'/>
	                        <button type="submit" className="btn btn-secondary" id='yes'><Link to = {'/my-categories'} onClick = {this.deleteCat}>Yes</Link></button>
	                          <button type="button" className="btn btn-default" data-dismiss="modal">No</button>
	                    </div>
	                </div>
              	</div>
          	</div>
		
		);
	}
}
export default Modal