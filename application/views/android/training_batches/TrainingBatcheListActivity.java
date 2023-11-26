
public class TrainingBatcheListActivity extends AppCompatActivity {
	
	static String[][] Items;
    private GoogleApiClient client;
	
	@Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        this.requestWindowFeature(Window.FEATURE_NO_TITLE);
        setContentView(R.layout.activity_list_training_batche);
		
		RequestQueue request_queue = Volley.newRequestQueue(TrainingBatcheListActivity.this);
		StringRequest request = new StringRequest(Request.Method.POST, SERVER_URL+"/mobile/training_batche/view", new Response.Listener<String>() {
								@Override
								public void onResponse(String server_response) {
								try {
                    			JSONArray JsonArray = new JSONArray(server_response);
								 Items = new String[JsonArray.length()][3];
								for(int i=0; i<=JsonArray.length(); i++){
									JSONObject json_object = JsonArray.getJSONObject(i);
									Items[i][0] = json_object.getString("training_id");
				Items[i][1] = json_object.getString("batch_title");
				Items[i][2] = json_object.getString("batch_detail");
				
			
								}
								
								TrainingBatcheAdapter trainingbatcheAdapter;
                    			trainingbatcheAdapter = new TrainingBatcheAdapter(TrainingBatcheListActivity.this,Items);
                    			training_batche_listView.setAdapter(trainingbatcheAdapter);
			
			
							} catch (JSONException e) {
								e.printStackTrace();
							    Toast.makeText(TrainingBatcheListActivity, "Error in Json", Toast.LENGTH_SHORT).show();
							}
								}
							}, new Response.ErrorListener() {
								@Override
								public void onErrorResponse(VolleyError volleyError) {
								Toast.makeText(TrainingBatcheListActivity, volleyError.toString(), Toast.LENGTH_SHORT).show();
								}
							}){
								@Override
								protected Map<String, String> getParams()  {
									HashMap<String,String> params = new HashMap<String,String>();
									return params;
								}
							};
							
				 request_queue.add(request);
		
		
		
 training_batche_listView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                Intent i = new Intent(TrainingBatcheListActivity.this, TrainingBatcheView.class);
                i.putExtra("batch_id", Items[position][0]);
                startActivity(i);
            }
        });
		
		

        
    }

}
