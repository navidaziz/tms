
public class TrainingEditActivity extends AppCompatActivity {
	
	private text code;
				private text title;
				private text level;
				private text category;
				private text sub_category;
				private text type;
				private text training_for;
				private text location;
				private EditText start_date;
				private EditText end_date;
				private text detail;
				private Button btn_update_trainings;
	
	@Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        this.requestWindowFeature(Window.FEATURE_NO_TITLE);
        setContentView(R.layout.activity_edit_training);
		
		code = (text)findViewById(R.id.code);
				title = (text)findViewById(R.id.title);
				level = (text)findViewById(R.id.level);
				category = (text)findViewById(R.id.category);
				sub_category = (text)findViewById(R.id.sub_category);
				type = (text)findViewById(R.id.type);
				training_for = (text)findViewById(R.id.training_for);
				location = (text)findViewById(R.id.location);
				start_date = (EditText)findViewById(R.id.start_date);
				end_date = (EditText)findViewById(R.id.end_date);
				detail = (text)findViewById(R.id.detail);
				btn_edit_trainings = (Button)findViewById(R.id.btn_update_trainings);
		
		
		
		Intent intent = getIntent();
		String id = intent.getStringExtra("id");
		
		RequestQueue request_queue = Volley.newRequestQueue(TrainingEditActivity.this);
		StringRequest request = new StringRequest(Request.Method.POST, SERVER_URL+"/mobile/training/view_training/"+id, new Response.Listener<String>() {
								@Override
								public void onResponse(String server_response) {
								try {
                    			JSONArray JsonArray = new JSONArray(server_response);
								for(int i=0; i<=JsonArray.length(); i++){
									JSONObject json_object = JsonArray.getJSONObject(i);
									code.setText(json_object.getString("code"));
				title.setText(json_object.getString("title"));
				level.setText(json_object.getString("level"));
				category.setText(json_object.getString("category"));
				sub_category.setText(json_object.getString("sub_category"));
				type.setText(json_object.getString("type"));
				training_for.setText(json_object.getString("training_for"));
				location.setText(json_object.getString("location"));
				start_date.setText(json_object.getString("start_date"));
				end_date.setText(json_object.getString("end_date"));
				detail.setText(json_object.getString("detail"));
				
			
								}
			
			
							} catch (JSONException e) {
								e.printStackTrace();
							 //   Toast.makeText(MainActivity.this, "error", Toast.LENGTH_SHORT).show();
							}
								}
							}, new Response.ErrorListener() {
								@Override
								public void onErrorResponse(VolleyError volleyError) {
								Toast.makeText(TrainingAddActivity.this, volleyError.toString(), Toast.LENGTH_SHORT).show();
								}
							}){
								@Override
								protected Map<String, String> getParams()  {
									HashMap<String,String> params = new HashMap<String,String>();
									return params;
								}
							};
							
				 request_queue.add(request);



	
btn_update_trainings.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
              final String form_code = code.getText().toString();
				final String form_title = title.getText().toString();
				final String form_level = level.getText().toString();
				final String form_category = category.getText().toString();
				final String form_sub_category = sub_category.getText().toString();
				final String form_type = type.getText().toString();
				final String form_training_for = training_for.getText().toString();
				final String form_location = location.getText().toString();
				final String form_start_date = start_date.getText().toString();
				final String form_end_date = end_date.getText().toString();
				final String form_detail = detail.getText().toString();
				
				
				RequestQueue request_queue = Volley.newRequestQueue(TrainingAddActivity.this); 
				 StringRequest request = new StringRequest(Request.Method.POST, url+"/mobile/training/save_data/"+form_training_id, new Response.Listener<String>() {
								@Override
								public void onResponse(String server_response) {
								Toast.makeText(TrainingAddActivity.this, server_response, Toast.LENGTH_SHORT).show();
								}
							}, new Response.ErrorListener() {
								@Override
								public void onErrorResponse(VolleyError volleyError) {
								Toast.makeText(TrainingAddActivity.this, volleyError.toString(), Toast.LENGTH_SHORT).show();
								}
							}){
								@Override
								protected Map<String, String> getParams()  {
									HashMap<String,String> params = new HashMap<String,String>();
									params.put("code", form_code);
				params.put("title", form_title);
				params.put("level", form_level);
				params.put("category", form_category);
				params.put("sub_category", form_sub_category);
				params.put("type", form_type);
				params.put("training_for", form_training_for);
				params.put("location", form_location);
				params.put("start_date", form_start_date);
				params.put("end_date", form_end_date);
				params.put("detail", form_detail);
				
									return params;
								}
							};
							
				 request_queue.add(request);
				
				
            }
        });
//end here .....
		
		
        
    }

}
