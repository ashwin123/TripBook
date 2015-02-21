package tripbook.main;

import tripbook.main.R;
import android.app.Fragment;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

public class ExpenseManagerFragment extends Fragment {
	
	public ExpenseManagerFragment(){}
	
	@Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
            Bundle savedInstanceState) {
 
        View rootView = inflater.inflate(R.layout.fragment_expencemanager, container, false);
         
        return rootView;
    }
}
