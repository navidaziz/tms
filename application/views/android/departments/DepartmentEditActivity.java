
public class DepartmentEditActivity extends AppCompatActivity {
	
	private text department_name;
				private text address;
				private Button btn_update_departments;
	
	@Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        this.requestWindowFeature(Window.FEATURE_NO_TITLE);
        setContentView(R.layout.activity_edit_department);
		
		department_name = (text)findViewById(R.id.department_name);
				address = (text)findViewById(R.id.address);
				btn_edit_departments = (Button)findViewById(R.id.btn_update_departments);
		
		
		
		Intent intent = getIntent();
		String id = intent.getStringExtra("id");
		
		RequestQueue request_queue = Volley.newRequestQueue(DepartmentEditActivity.this);
		StringRequest request = new StringRequest(Request.Method.POST, SERVER_URL+"/mobile/department/view_department/"+id, new Response.Listener<String>() {
								@Override
								public void onResponse(String server_response) {
								try {
                    			JSONArray JsonArray = new JSONArray(server_response);
								for(int i=0; i<=JsonArray.length(); i++){
									JSONObject json_object = JsonArray.getJSONObject(i);
									department_name.setText(json_object.getString("department_name"));
				address.setText(json_object.getString("address"));
				
			
								}
			
			
							} catch (JSONException e) {
								e.printStackTrace();
							 //   Toast.makeText(MainActivity.this, "error", Toast.LENGTH_SHORT).show();
							}
								}
							}, new Response.ErrorListener() {
								@Override
								public void onErrorResponse(VolleyError volleyError) {
								Toast.makeText(DepartmentAddActivity.this, volleyError.toString(), Toast.LENGTH_SHORT).show();
								}
							}){
								@Override
								protected Map<String, String> getParams()  {
									HashMap<String,String> params = new HashMap<String,String>();
									return params;
								}
							};
							
				 request_queue.add(request);



	
btn_update_departments.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
              final String form_department_name = department_name.getText().toString();
				final String form_address = address.getText().toString();
				
				
				RequestQueue request_queue = Volley.newRequestQueue(DepartmentAddActivity.this); 
				 StringRequest request = new StringRequest(Request.Method.POST, url+"/mobile/department/save_data/"+form_department_id, new Response.Listener<String>() {
								@Override
								public void onResponse(String server_response) {
								Toast.makeText(DepartmentAddActivity.this, server_response, Toast.LENGTH_SHORT).show();
								}
							}, new Response.ErrorListener() {
								@Override
								public void onErrorResponse(VolleyError volleyError) {
								Toast.makeText(DepartmentAddActivity.this, volleyError.toString(), Toast.LENGTH_SHORT).show();
								}
							}){
								@Override
								protected Map<String, String> getParams()  {
									HashMap<String,String> params = new HashMap<String,String>();
									params.put("department_name", form_department_name);
				params.put("address", form_address);
				
									return params;
								}
							};
							
				 request_queue.add(request);
				
				
            }
        });
//end here .....
		
		
        
    }

}
