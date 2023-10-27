@php
    function updateData() {
        $update_data = DB::select('SELECT * FROM update_data');
        $data = [];
        
        foreach ($update_data as $key => $update_data) {
            $data[$key] = [
                'id' => $update_data->id,
                'update_time' => $update_data->update_time
            ];
        }
        
        return $data;
    }

    function updateDataPenduduk(){
        return updateData()[0];
    }
@endphp