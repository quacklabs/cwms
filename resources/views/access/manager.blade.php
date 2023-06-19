<div class="card-body">
    <form action="{{ route('access.modifyByRole', ['role' => 'manager']) }}" method="POST">
        @csrf
        <div class="form-group row">
            <div class="col-sm-4">
                <h5>User Permissions</h5>
            </div>
            <div class="col-sm-8">
                @foreach($user_permissions as $user_permission)
                <div class="form-check">
                    
                    <input name="{{ $user_permission->name }}" class="form-check-input" type="checkbox"
                        @if($manager_role->hasPermissionTo($user_permission->name))
                            checked
                        @endif
                    >
                    <label class="form-check-label" for="gridCheck1">
                    
                    {{ ucwords(str_replace('-', ' ', $user_permission->name)) }}
                    </label>
                </div>
                @endforeach
            </div>
        </div>
        <hr>

        <div class="form-group row">
            <div class="col-sm-4">
                <h5>Store Permissions</h5>
            </div>
            <div class="col-sm-8">
                @foreach($store_permissions as $store_permission)
                <div class="form-check">
                    
                    <input name="{{ $store_permission->name }}" class="form-check-input" type="checkbox"
                        @if($manager_role->hasPermissionTo($store_permission->name))
                            checked
                        @endif
                    >
                    <label class="form-check-label" for="gridCheck1">
                    
                    {{ ucwords(str_replace('-', ' ', $store_permission->name)) }}
                    </label>
                </div>
                @endforeach
            </div>
            
        </div>
        <hr>

        <div class="form-group row">
            <div class="col-sm-4">
                <h5>Warehouse Permissions</h5>
            </div>

            <div class="col-sm-8">
                @foreach($warehouse_permissions as $warehouse_permission)
                <div class="form-check">
                    
                    <input name="{{ $warehouse_permission->name }}" class="form-check-input" type="checkbox"
                        @if($manager_role->hasPermissionTo($warehouse_permission->name))
                            checked
                        @endif
                    >
                    <label class="form-check-label" for="gridCheck1">
                    
                    {{ ucwords(str_replace('-', ' ', $warehouse_permission->name)) }}
                    </label>
                </div>
                @endforeach
            </div>
        </div>
        <hr>

        <div class="form-group row">
            <div class="col-sm-4">
                <h5>Product Permissions</h5>
            </div>

            <div class="col-sm-8">
                @foreach($product_permissions as $product_permission)
                <div class="form-check">
                    
                    <input name="{{ $product_permission->name }}"  class="form-check-input" type="checkbox"
                        @if($manager_role->hasPermissionTo($product_permission->name))
                            checked
                        @endif
                    >
                    <label class="form-check-label" for="gridCheck1">
                    
                    {{ ucwords(str_replace('-', ' ', $product_permission->name)) }}
                    </label>
                </div>
                @endforeach
            </div>
        </div>

        <hr>
        <div class="form-group row">
            <button class="btn btn-large btn-primary" type="submit">Save</button>
        </div>
    </form>
</div>