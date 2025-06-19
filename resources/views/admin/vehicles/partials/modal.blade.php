<!-- Modal -->
<div class="modal fade" id="vehicleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header bg-dark">
          <h5 class="modal-title" id="exampleModalLabel">Nuevo Vehículo</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
            <div class="card card-warning">
               
                <!-- /.card-header -->
                <div class="card-body">
                  <span class="text-danger">* Campos Obligatorios</span>
                  <form id="vehicleForm" enctype="multipart/form-data">
                    <div id="error-messages" class="alert alert-danger d-none"></div> 
                    @csrf
                    <!-- input states -->                      
                    <div class="row">
                      <div class="col-sm-6">
                        <!-- select -->
                        <div class="form-group">
                          <label class="col-form-label" for="plate"><i class="fas fa-asterisk" style="color: red;font-size: 8px"></i> Placa del Vehículo</label>
                          <input type="text" class="form-control" id="plate" name="plate" placeholder="Escriba la Placa del Vehículo" required>
                             
                        </div>  
                      </div> 
                      <div class="col-sm-6">
                        <!-- select -->
                        <div class="form-group">
                          <label class="col-form-label" for="model"><i class="fas fa-asterisk" style="color: red;font-size: 8px"></i> Modelo del Vehículo</label>
                          <input type="text" class="form-control" id="model" name="model" placeholder="Escriba el Modelo del Vehículo" required>
                            
                        </div>  
                      </div> 
                    </div> 
                    
                    <div class="row">
                      <div class="col-sm-6">
                        <!-- select -->
                        <div class="form-group">
                          <label><i class="fas fa-asterisk" style="color: red;font-size: 8px"></i> Tipo de Vehículo</label>
                          <select class="form-control select2bs4" style="width: 100%;" name="type_id">
                            @foreach ($types as $type)
                            <option value="{{$type->id}}">{{$type->name}}</option>
                            @endforeach                         
                          </select>
                        </div>
                      </div> 
                      <div class="col-sm-6">
                        <!-- select -->
                        <div class="form-group">
                          <label> <i class="fas fa-asterisk" style="color: red;font-size: 8px"></i> Marca de Vehículo</label>
                          <select class="form-control select2bs4" style="width: 100%;" name="brand_id">
                            @foreach ($brands as $brand)
                              <option value="{{$brand->id}}">{{$brand->name}}</option>
                            @endforeach                            
                          </select>
                        </div> 
                      </div> 
                    </div>  
                    <div class="row">
                      <div class="col-sm-2">
                        <!-- select -->
                        <div class="form-group">
                          <label class="col-form-label" for="color"><i class="fas fa-asterisk" style="color: red;font-size: 8px"></i> Color</label>
                          <input type="text" class="form-control" id="color" name="color" placeholder="Color del Vehículo" required>
                           
                        </div>  
                      </div> 
                      <div class="col-sm-2">
                        <!-- select -->
                        <div class="form-group">
                          <label class="col-form-label" for="year"><i class="fas fa-asterisk" style="color: red;font-size: 8px"></i> Año </label>
                          <input type="text" class="form-control" id="year" name="year" placeholder="Año del Vehículo" required>
                            
                        </div>  
                      </div> 

                      <div class="col-sm-4">
                        <!-- select -->
                        <div class="form-group">
                          <label class="col-form-label" for="engine_number"><i class="fas fa-check"></i> Numero de Motor</label>
                          <input type="text" class="form-control" id="engine_number" name="engine_number" placeholder="Escriba el Numero de Motor">
                            
                        </div>  
                      </div> 
                      <div class="col-sm-4">
                        <!-- select -->
                        <div class="form-group">
                          <label class="col-form-label" for="chassis_number"><i class="fas fa-check"></i> Numero de Chasis</label>
                          <input type="text" class="form-control" id="chassis_number" name="chassis_number" placeholder="Escriba el Numero de Chasis">
                           
                        </div>  
                      </div> 
                    </div> 
                    <div class="row">
                      <div class="col-sm-4">
                        <!-- select -->
                        <div class="form-group">
                          <label> <i class="fas fa-asterisk" style="color: red;font-size: 8px"></i> Trasmisión</label>
                          <select class="form-control" name="transmission">
                            <option value="Manual">Manual</option>
                            <option value="Automático">Automático</option>
                            
                          </select>
                        </div> 
                      </div> 
                      <div class="col-sm-4">
                        <!-- select -->
                        <div class="form-group">
                          <label class="col-form-label" for="seats"><i class="fas fa-check"></i> N°. Asientos</label>
                          <input type="number" class="form-control" id="seats" name="seats" placeholder=" N°. Asientos">
                           
                        </div>  
                      </div> 
                      <div class="col-sm-4">
                        <!-- select -->
                        <div class="form-group">
                          <label class="col-form-label" for="fuel"><i class="fas fa-check"></i>Combustible</label>
                          <input type="text" class="form-control" id="fuel" name="fuel" placeholder=" Combustible">
                           
                        </div>  
                      </div> 
                      
                   
                    </div> 
                    <div class="row">
                      <div class="col-sm-12">
                        <!-- select -->
                        <div class="form-group">
                          <label class="col-form-label" for="description"><i class="fas fa-check"></i> Descripción</label>
                          <textarea class="form-control" id="description" name="description" placeholder="Escriba una Descripción"></textarea>
                              
                        </div>  
                      </div>                  
             
                    </div>  
                    <div class="row">
                  
                      <div class="col-sm-6">
                        <!-- select -->
                        <div class="form-group">
                          <label> <i class="fas fa-asterisk" style="color: red;font-size: 8px"></i> Estado</label>
                          <select class="form-control" name="status">
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                            
                          </select>
                        </div> 
                      </div> 
                      <div class="col-md-6">
                        <div class="position-relative mb-2" style="aspect-ratio: 16/9;">
                          <img id="imgPreview" src="https://thumb.ac-illust.com/b1/b170870007dfa419295d949814474ab2_t.jpeg"
                               class="w-100 h-100 object-fit-cover rounded"
                               style="position: absolute; inset: 0;" alt="image">
                      
                          <label class="position-absolute top-0 start-0 m-2 bg-white px-3 py-1 rounded shadow-sm"
                                 style="cursor: pointer;">
                                 IMAGEN <i class="fas fa-upload"></i>
                            <input type="file" class="d-none" name="image" id="image" accept="image/*" onchange="previewImage(event, '#imgPreview')">
                          </label>
                        </div>
                      </div>
                      
                      
             
                    </div>     

                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                      <button type="submit" class="btn btn-primary">Guardar</button>
                    
                  </form>
                </div>
                <!-- /.card-body -->
              </div>
        
          
        </div>
        </div>
      </div>
    </div>
        