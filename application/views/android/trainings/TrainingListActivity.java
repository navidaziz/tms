
public class TrainingListActivity extends AppCompatActivity {
	
	static String[][] Items;
    private GoogleApiClient client;
	
	@Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        this.requestWindowFeature(Window.FEATURE_NO_TITLE);
        setContentView(R.layout.activity_list_training);
		
		RequestQueue request_queue = Volley.newRequestQueue(TrainingListActivity.this);
		StringRequest request = new StringRequest(Request.Method.POST, SERVER_URL+"/mobile/training/view", new Response.Listener<String>() {
								@Override
								public void onResponse(String server_response) {
								try {
                    			JSONArray JsonArray = new JSONArray(server_response);
								 Items = new String[JsonArray.length()][11];
								for(int i=0; i<=JsonArray.length(); i++){
									JSONObject json_object = JsonArray.getJSONObject(i);
									Items[i][0] = json_object.getString("code");
				Items[i][1] = json_object.getString("title");
				Items[i][2] = json_object.getString("level");
				Items[i][3] = json_object.getString("category");
				Items[i][4] = json_object.getString("sub_category");
				Items[i][5] = json_object.getString("type");
				Items[i][6] = json_object.getString("training_for");
				Items[i][7] = json_object.getString("location");
				Items[i][8] = json_object.getString("start_date");
				Items[i][9] = json_object.getString("end_date");
				Items[i][10] = json_object.getString("detail");
				
			
								}
								
								TrainingAdapter trainingAdapter;
                    			trainingAdapter = new TrainingAdapter(TrainingListActivity.this,Items);
                    			training_listView.setAdapter(trainingAdapter);
			
			
							} catch (JSONException e) {
								e.printStackTrace();
							    Toast.makeText(TrainingListActivity, "Error in Json", Toast.LENGTH_SHORT).show();
							}
								}
							}, new Response.ErrorListener() {
								@Override
								public void onErrorResponse(VolleyError volleyError) {
								Toast.makeText(TrainingListActivity, volleyError.toString(), Toast.LENGTH_SHORT).show();
								}
							}){
								@Override
								protected Map<String, String> getParams()  {
									HashMap<String,String> params = new HashMap<String,String>();
									return params;
								}
							};
							
				 request_queue.add(request);
		
		
		
 training_listView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                Intent i = new Intent(TrainingListActivity.this, TrainingView.class);
                i.putExtra("training_id", Items[position][0]);
                startActivity(i);
            }
        });
		
		

        
    }

}
