package com.example.olparc;

import java.util.ArrayList;
import java.util.List;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONException;
import org.json.JSONObject;

import android.app.ProgressDialog;
import android.net.NetworkInfo.DetailedState;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v7.app.ActionBarActivity;
import android.text.InputType;
import android.util.Log;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.AdapterView;
import android.widget.AdapterView.OnItemClickListener;
import android.widget.AdapterView.OnItemSelectedListener;
import android.widget.Button;
import android.widget.EditText;
import android.widget.LinearLayout;
import android.widget.LinearLayout.LayoutParams;
import android.widget.Spinner;

public class OnlinePurchase extends ActionBarActivity {
	
	
	EditText [] number;
	EditText num1;
	EditText ltr;
	EditText bns;
	ProgressDialog prodialog;  //progress dialog to indicate the waiting period or loading period
	JSONparser jparser = new JSONparser(); //creating an object from jsonparsen class to pass data to database
	String lotteryname="";
	LinearLayout number_layout;
	private static final String TAG_SUCCESS = "success";
	private static String url_lotteryDetails = "http://olparc.16mb.com/db_lotterydetails.php";
	Spinner lotterySpinner;
	LinearLayout.LayoutParams params;
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_onlinepurchasing);
		lotterySpinner = (Spinner)findViewById(R.id.spinnerLotteryname)		;
		number_layout=(LinearLayout)findViewById(R.id.number_layout);
		 num1=(EditText)findViewById(R.id.edit_number1);
		Button btnSet = (Button)findViewById(R.id.buttonSet);
		params =(LayoutParams) num1.getLayoutParams();
		
		/*numbers=new EditText[countOfNo];
		numbers[0] = num1;
		num1.setHint("Num 1");
		
		for(int i=1;i<countOfNo;i++){
			EditText temp = new EditText(this);
			temp.setLayoutParams(params);
			if(i+1==countOfNo){
				temp.setInputType(InputType.TYPE_CLASS_TEXT);
				temp.setHint("Letter");
			}
			else{
				
			}
			number_layout.addView(temp);
			numbers[i]=temp;
			
			
		}*/
		
		lotterySpinner.setOnItemSelectedListener(new OnItemSelectedListener() {
		    @Override
		    public void onItemSelected(AdapterView<?> parentView, View selectedItemView, int position, long id) {

				lotteryname =lotterySpinner.getSelectedItem().toString();
				
				new Details().execute();
		    }

		    @Override
		    public void onNothingSelected(AdapterView<?> parentView) {

				lotteryname =lotterySpinner.getSelectedItem().toString();
				
				new Details().execute();
		    }

		});

		
	}
class Details extends AsyncTask<String, String, String>{
		
		int success=0 ;
		 int letter ;
    	 int special;
    	 int sign;
    	 int numbers;
    	 int limit;
		@Override
	    protected void onPreExecute() {
	        super.onPreExecute();
	        prodialog = new ProgressDialog(OnlinePurchase.this);
	        prodialog.setMessage("Setting layout.");
	        prodialog.setIndeterminate(false);
	        prodialog.setCancelable(true);
	        prodialog.show();
	    }
		
		@Override
		protected String doInBackground(String... args) {
			// Converting Input data to String and intger to input to the database
			
			String lottery = lotteryname;
			
			
			
			List<NameValuePair> param = new ArrayList<NameValuePair>();
			param.add(new BasicNameValuePair("lotteryname", lottery));
			
			
			JSONObject json = jparser.makeHttpRequest(url_lotteryDetails, "GET", param);
			
			Log.d("Create Response", json.toString());
		
			 
            // check for success tag
            try {
                success = json.getInt(TAG_SUCCESS);
                
                if (success == 1) {
                	 letter = json.getInt("letter");
                	 special =json.getInt("specialnumber");
                	 sign =json.getInt("sign");
                	 numbers = json.getInt("numbers");
                	 limit = json.getInt("limit");
                                  // successfully created product
                	 
                	
                } else {
                    // failed to create product
                }
            } catch (JSONException e) {
                e.printStackTrace();
            }
			return null;
		}
		
		 protected void onPostExecute(String file_url) {
	            // dismiss the dialog once done
			 number=new EditText[numbers];

	           	number_layout.removeAllViews();
	          int j=1; 
	         if(letter==1){
       			 
        			EditText temp = new EditText(OnlinePurchase.this);
        			temp.setLayoutParams(params); 
        			temp.setInputType(InputType.TYPE_CLASS_TEXT);
        			temp.setHint("Letter");
        			temp.setId(j);
        			j++;
   				   				
   				number_layout.addView(temp);
   				
           	 }
           	 if(special==1){
           		 EditText temp = new EditText(OnlinePurchase.this);
        			 temp.setLayoutParams(params); 
        			 temp.setInputType(InputType.TYPE_CLASS_NUMBER);
        			 temp.setHint("Bonus");
        			 temp.setId(j);
        			 number_layout.addView(temp);
        			 j++;
           	 }
           	 
           	 for(int i=0;i<numbers;i++){
           		 
           		 EditText temp = new EditText(OnlinePurchase.this);
        			 temp.setLayoutParams(params); 
        			temp.setInputType(InputType.TYPE_CLASS_NUMBER);
   				temp.setHint("Num "+(i+1));
   				temp.setId(j);
   				j++;
   				number_layout.addView(temp);
   				number[i]=temp;
           	 }
           	 prodialog.dismiss();
	         
	        }
	 
		
	}
	

}
