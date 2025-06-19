<!-- Modal -->
<div class="modal fade" id="reservationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header bg-dark">
          <h5 class="modal-title" id="exampleModalLabel">Nueva Marca</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
            <div class="card card-warning">
               
                <!-- /.card-header -->
                <div class="card-body">
                  <form id="brandForm">
                    @csrf
                    <!-- input states -->
                                  

                    <div class="row">

                    <div class="col-sm-6">
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">Vehículo</h3>

                        <div class="card-tools">
                          <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                            <div class="input-group-append">
                              <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body table-responsive p-0" style="height: 300px;">
                        <table class="table table-head-fixed text-nowrap">
                          <thead>
                            <tr>
                              <th>Select</th>
                              <th>Id</th>
                              <th>Placa</th>
                              <th>Tipo</th>
                              <th>Modelo</th>
                          
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($vehicles as $vehicle)
                                <tr>
                                  <td>
                                  <input type="radio" name="vehicle_id" value="{{ $vehicle->id }}" required>
                                  </td>
                                  <td>{{$vehicle->id}}</td>
                                  <td>{{$vehicle->plate}}</td>
                                  <td>{{$vehicle->type->name}}</td>
                                  <td>{{$vehicle->model}}</td>
                                  
                                </tr>                                
                            @endforeach                      

                          </tbody>
                        </table>
                      </div>
                      <!-- /.card-body -->
                    </div>
            <!-- /.card -->
          </div>

                      <div class="col-sm-6">
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
        