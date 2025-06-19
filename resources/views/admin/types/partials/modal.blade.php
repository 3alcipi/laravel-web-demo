<!-- Modal -->
<div class="modal fade" id="typeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header bg-dark">
          <h5 class="modal-title" id="exampleModalLabel">Nuevo Tipo de Vehículo</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
            <div class="card card-warning">
               
                <!-- /.card-header -->
                <div class="card-body">
                  <form id="typeForm">
                    @csrf
                    <!-- input states -->
                    <div class="form-group">
                      <label class="col-form-label" for="name"><i class="fas fa-check"></i> Tipo de Vehículo</label>
                      <input type="text" class="form-control" id="name" name="name" placeholder="Nombre de la Tipo de vehículo" required>
                      <div id="error-messages" class="alert alert-danger d-none"></div>

                    </div>                 

                    <div class="row">
                      <div class="col-sm-12">
                        <!-- select -->
                        <div class="form-group">
                          <label>Estado</label>
                          <select class="form-control" name="status">
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                            
                          </select>
                        </div>
                      </div>
                    
                    </div>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Guardar</button>
                    
                  </form>
                </div>
                <!-- /.card-body -->
              </div>
        
          
        </div>
        </div>
      </div>
    </div>
        