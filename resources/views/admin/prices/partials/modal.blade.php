<!-- Modal -->
<div class="modal fade" id="priceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header bg-dark">
          <h5 class="modal-title" id="exampleModalLabel">Nueva Precio</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
            <div class="card card-warning">
               
                <!-- /.card-header -->
                <div class="card-body">
                  <form id="priceForm">
                    @csrf
                    <!-- input states -->
                    <div class="form-group">
                        <label><i class="fas fa-asterisk" style="color: red;font-size: 8px"></i> Vehiculo</label>
                        <select class="form-control select2bs4" style="width: 100%;" name="vehicle_id">
                          @foreach ($vehicles as $vehicle)
                          <option value="{{$vehicle->id}}">Placa: {{$vehicle->plate}}→ Modelo: {{$vehicle->model}}</option>
                          @endforeach                         
                        </select>
                      </div>
                    <div class="form-group">
                      <label class="col-form-label" for="price_day"><i class="fas fa-check"></i> Precio</label>
                      <input type="text" class="form-control" id="price_day" name="price_day" placeholder="Precio por Día">
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
        