
public class TrainingBatcheEditActivity extends AppCompatActivity {
	
	private EditText training_id;
				private text batch_title;
				private text batch_detail;
				private Button btn_update_training_batches;
	
	@Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        this.requestWindowFeature(Window.FEATURE_NO_TITLE);
        setContentView(R.layout.activity_edit_training_batche);
		
		training_id = (EditText)findViewById(R.id.training_id);
				batch_title = (text)findViewById(R.id.batch_title);
				batch_detail = (text)findViewById(R.id.batch_detail);
				btn_edit_training_batches = (Button)findViewById(R.id.btn_update_training_batches);
		
		
		
		Intent intent = getIntent();
		String id = intent.getStringExtra("id");
		
		RequestQueue request_queue = Volley.newRequestQueue(TrainingBatcheEditActivity.this);
		StringRequest request = new StringRequest(Request.Method.POST, SERVER_URL+"/mobile/training_batche/view_training_batche/"+id, new Response.Listener<String>() {
								@Override
								public void onResponse(String server_response) {
								try {
                    			JSONArray JsonArray = new JSONArray(server_response);
								for(int i=0; i<=JsonArray.length(); i++){
									JSONObject json_object = JsonArray.getJSONObject(i);
									training_id.setText(json_object.getString("training_id"));
				batch_title.setText(json_object.getString("batch_title"));
				batch_detail.setText(json_object.getString("batch_detail"));
				
			
								}
			
			
							} catch (JSONException e) {
								e.printStackTrace();
							 //   Toast.makeText(MainActivity.this, "error", Toast.LENGTH_SHORT).show();
							}
								}
							}, new Response.ErrorListener() {
								@Override
								public void onErrorResponse(VolleyError volleyError) {
								Toast.makeText(TrainingBatcheAddActivity.this, volleyError.toString(), Toast.LENGTH_SHORT).show();
								}
							}){
								@Override
								protected Map<String, String> getParams()  {
									HashMap<String,String> params = new HashMap<String,String>();
									return params;
								}
							};
							
				 request_queue.add(request);



	
btn_update_training_batches.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
              final String form_training_id = training_id.getText().toString();
				final String form_batch_title = batch_title.getText().toString();
				final String form_batch_detail = batch_detail.getText().toString();
				
				
				RequestQueue request_queue = Volley.newRequestQueue(TrainingBatcheAddActivity.this); 
				 StringRequest request = new StringRequest(Request.Method.POST, url+"/mobile/training_batche/save_data/"+form_batch_id, new Response.Listener<String>() {
								@Override
								public void onResponse(String server_response) {
								Toast.makeText(TrainingBatcheAddActivity.this, server_response, Toast.LENGTH_SHORT).show();
								}
							}, new Response.ErrorListener() {
								@Override
								public void onErrorResponse(VolleyError volleyError) {
								Toast.makeText(TrainingBatcheAddActivity.this, volleyError.toString(), Toast.LENGTH_SHORT).show();
								}
							}){
								@Override
								protected Map<String, String> getParams()  {
									HashMap<String,String> params = new HashMap<String,String>();
									params.put("training_id", form_training_id);
				params.put("batch_title", form_batch_title);
				params.put("batch_detail", form_batch_detail);
				
									return params;
								}
							};
							
				 request_queue.add(request);
				
				
            }
        });
//end here .....
		
		
        
    }

}
