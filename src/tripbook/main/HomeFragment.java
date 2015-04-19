package tripbook.main;

import java.io.IOException;
import java.util.List;

import com.google.android.gms.maps.CameraUpdateFactory;
import com.google.android.gms.maps.GoogleMap;
import com.google.android.gms.maps.MapView;
import com.google.android.gms.maps.MapsInitializer;
import com.google.android.gms.maps.model.BitmapDescriptorFactory;
import com.google.android.gms.maps.model.CameraPosition;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.gms.maps.model.MarkerOptions;

import tripbook.main.R;
import android.app.AlertDialog;
import android.app.Fragment;
import android.content.DialogInterface;
import android.location.Address;
import android.location.Geocoder;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.EditText;

public class HomeFragment extends Fragment {
	
	 List<Address> addresses;
	MapView mMapView;
	private GoogleMap googleMap;
	private Button btSearch;
	private EditText etfrom;
	
	 static final LatLng HAMBURG = new LatLng(53.558, 9.927);
	  static final LatLng KIEL = new LatLng(53.551, 9.993);
	 // private GoogleMap map;
	
	
	@Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
            Bundle savedInstanceState) {
 
        View rootView = inflater.inflate(R.layout.fragment_home, container, false);
         //hhhdh
        
      //  map = ((MapFragment) getFragmentManager().findFragmentById(R.id.map))
        //        .getMap();
        
        etfrom=(EditText) rootView.findViewById(R.id.etfrom);
        btSearch=(Button) rootView.findViewById(R.id.btnSearch);
        mMapView = (MapView) rootView.findViewById(R.id.map1);
        mMapView.onCreate(savedInstanceState);

        mMapView.onResume();// needed to get the map to display immediately
        
        try {
            MapsInitializer.initialize(getActivity().getApplicationContext());
        } catch (Exception e) {
            e.printStackTrace();
        }
        googleMap = mMapView.getMap();
        
        googleMap.setMyLocationEnabled(true);
        googleMap.getUiSettings().setZoomControlsEnabled(false);
        googleMap.getUiSettings().setMyLocationButtonEnabled(true);
        
        
        
        
      //  googleMap.setMapType(GoogleMap.MAP_TYPE_NORMAL);
       // googleMap.setMapType(GoogleMap.MAP_TYPE_HYBRID);
      //  googleMap.setMapType(GoogleMap.MAP_TYPE_SATELLITE);
        //googleMap.setMapType(GoogleMap.MAP_TYPE_TERRAIN);
        //googleMap.setMapType(GoogleMap.MAP_TYPE_NONE);
        
        // latitude and longitude
        double latitude = 13.0017243;
        double longitude = 77.5386537;
        
     // create marker
        MarkerOptions marker = new MarkerOptions().position(
                new LatLng(latitude, longitude)).title("Your Here");

        
        
        
        // Changing marker icon
        marker.icon(BitmapDescriptorFactory
                .defaultMarker(BitmapDescriptorFactory.HUE_ROSE));
        
        
       /* 
        
     // create marker
        MarkerOptions marker1 = new MarkerOptions().position(new LatLng(latitude, longitude+0.0044412)).title("Hi");
         
        // Changing marker icon
        marker1.icon(BitmapDescriptorFactory.fromResource(R.drawable.ic_login));
         
        // adding marker
        googleMap.addMarker(marker1);
        */

        
     // adding marker
        googleMap.addMarker(marker);
        CameraPosition cameraPosition = new CameraPosition.Builder()
                .target(new LatLng(latitude, longitude)).zoom(12).build();
        googleMap.animateCamera(CameraUpdateFactory
                .newCameraPosition(cameraPosition));
       
       /*
        
        final Geocoder geocoder = new Geocoder(getActivity().getApplicationContext());  
        btSearch.setOnClickListener(new OnClickListener() {
			
			@Override
			public void onClick(View arg0) {
				String mysearch=etfrom.getText().toString();
				
				if(mysearch.equals("")){
					showAlert();
				}
				
				if(mysearch!=null){
				
				try {
						addresses = geocoder.getFromLocationName(mysearch, 1);
					} catch (IOException e) {
						// TODO Auto-generated catch block
						e.printStackTrace();
					}
			        if(addresses.size() > 0) {
			            double latitude1= addresses.get(0).getLatitude();
			            double longitude1= addresses.get(0).getLongitude();
			            System.out.println("latitude:"+latitude1+"longitude"+longitude1);
			            MarkerOptions markerSearch = new MarkerOptions().position(
			                    new LatLng(latitude1, longitude1)).title(mysearch);
			            markerSearch.icon(BitmapDescriptorFactory
			                    .defaultMarker(BitmapDescriptorFactory.HUE_CYAN));
			            
			            
			            googleMap.addMarker(markerSearch);
			            CameraPosition cameraPosition = new CameraPosition.Builder()
			                    .target(new LatLng(latitude1, longitude1)).zoom(12).build();
			            googleMap.animateCamera(CameraUpdateFactory
			                    .newCameraPosition(cameraPosition));
			            
			            
			        }}
				
			        
				
			}
		});
		*/
        
       
       
       
        
        return rootView;
    }

	/*
	
	public void showAlert(){
        getActivity().runOnUiThread(new Runnable() {
            public void run() {
            	//op.setTextColor(getResources().getColor(R.color.red));
                //op.setText("Username or Password Wrong");
                AlertDialog.Builder builder = new AlertDialog.Builder(getActivity());
                
               
                builder.setMessage("Please Enter Some place Name.")  
                       .setCancelable(false)
                       .setPositiveButton("OK", new DialogInterface.OnClickListener() {
                           public void onClick(DialogInterface dialog, int id) {
                           }
                       });                     
                AlertDialog alert = builder.create();
                
               // op.startAnimation(anim);
               
               
                //et.setHint("Invalid");
                //et.setHintTextColor(getResources().getColor(R.color.red));
                //pass.setText("");
               // pass.setHint("Invalid");
                //et.setHintTextColor(getResources().getColor(R.color.red));
                //pass.setHintTextColor(getResources().getColor(R.color.red));
                alert.show();
              // builder.setCancelable(true);
                alert.setCanceledOnTouchOutside(true);
            }
        });
    }	*/
@Override
public void onResume() {
    super.onResume();
    mMapView.onResume();
}

@Override
public void onPause() {
    super.onPause();
    mMapView.onPause();
}
	

@Override
public void onDestroy() {
    super.onDestroy();
    mMapView.onDestroy();
}

@Override
public void onLowMemory() {
    super.onLowMemory();
    mMapView.onLowMemory();
}

}
