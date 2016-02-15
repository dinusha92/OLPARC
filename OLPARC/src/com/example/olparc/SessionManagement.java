package com.example.olparc;
import java.util.HashMap;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.content.SharedPreferences.Editor; 


public class SessionManagement {
	SharedPreferences sharedpref; //Making an instance of SharedPreference
	Editor editor; // Making an instance of the editor for the sharedPreference
	Context  cntext;
	
	int PRIVATE_MODE = 0; //for shared preference mode
	
	private static final String PREF_NAME = "OLPARCPref";
	
	private static final String IS_LOGIN = "IsLoggedIn";
	
	private static final String KEY_NAME = "name";
	
	public SessionManagement(Context context){
		this.cntext = context; 
		sharedpref = cntext.getSharedPreferences(PREF_NAME, PRIVATE_MODE);
		editor = sharedpref.edit();
		
		
	}
	
	public void createLoginSession(String name){
		editor.putBoolean(IS_LOGIN, true);
		editor.putString(KEY_NAME, name);
		editor.commit();
		
	}
	
	public void checkLogin(){
		if(!this.isLoggedIn()){
			Intent login = new Intent(cntext, MainActivity.class);
			login.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
			login.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
			cntext.startActivity(login);
		}
	}
	
	public HashMap<String, String> getUserDetails(){
		HashMap<String, String> user = new HashMap<String, String>();
        // user name
        user.put(KEY_NAME, sharedpref.getString(KEY_NAME, null));
        // return user
        return user;
	}
	
	public void logoutUser(){
        // Clearing all data from Shared Preferences
        editor.clear();
        editor.commit();
         
        // After logout redirect user to Loing Activity
        Intent logout = new Intent(cntext, MainActivity.class);
        // Closing all the Activities
        logout.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
         
        // Add new Flag to start new Activity
        logout.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
         
        // Staring Login Activity
        cntext.startActivity(logout);
    }
	public boolean isLoggedIn(){
        return sharedpref.getBoolean(IS_LOGIN, false);
    }
}
