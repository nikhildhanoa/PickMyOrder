<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| ----------------------------------------------------x`---------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
$route['business'] = 'Welcome/business';
$route['dashboard'] = 'Welcome/login';
$route['index'] = 'Welcome/index';
$route['users'] = 'Welcome/users';
$route['orders'] = 'OrdersController/Orders';

$route['category'] = 'ProductCategoryController/category';
$route['user_verification'] = 'Welcome/User_verification';
$route['forgotpassword'] = 'Welcome/ForgotPassword';
$route['delete'] = 'Welcome/Remove';
$route['get_products'] = 'Welcome/Fetch_products';
$route['editbusiness'] = 'Welcome/Editbusiness';
$route['editusers'] = 'Welcome/Editusers';
$route['adminlogin'] = 'Welcome/Adminloginbysuperadmin';
$route['logout'] = 'LogControl/Logout';
$route['getproductcategory'] = 'ProductApiControl/Getcategory';
$route['getproductsubcategory']='ProductApiControl/Getsubcategory';
$route['getproductsupersubcategory']='ProductApiControl/Getsupersubcategory';
$route['getproducts']='ProductApiControl/Getproducts';
$route['getproductsinios']='ProductApiControl/Getproductsinios';   //api for ios
$route['engineer']='EngineerController/Engineer';
$route['editengineer'] = 'EngineerController/EditEngineer';
$route['deleteengineer']='EngineerController/DeleteEngineer';
$route['editsuppliers']='SupplierController/EditSupplier';
$route['deletesuppliers']='SupplierController/Delete_Supplier';
$route['editprojects']='ProjectController/EditProjects';
$route['deleteproject']='ProjectController/DeleteProject';
//user section (user exisit or not)
$route['checkuserexsist']='Welcome/CheckUserExsist';

/*******************************quotes******************/
$route['quotes'] = 'QuotesController/Quotes';
$route['View_Single_Quote']='QuotesController/View_Single_Quote';
$route['DeleteQuote']='QuotesController/DeleteQuote';

// ORDER SECTION
$route['ExportOrder']='OrdersController/ExportOrder';
$route['uncheckedaorderprint']='OrdersController/uncheckedaorderprint';
$route['UpdateIdinTableForPrint']='OrdersController/UpdateIdinTableForPrint';
$route['gotoprinter']='OrdersController/Printer';
$route['insertidintableforprint']='OrdersController/InsertIdinTableForPrint';
$route['Cancleorder']='OrdersController/CancleOrder';
$route['addline']='OrdersController/AddLine';
$route['manageOrder']='OrdersController/ManageOrder';
$route['manageOrderEdit']='OrdersController/EditManageOrder'; //EDIT SINGLE ORDER
$route['updateqty']='OrdersController/UpdateQty';
$route['GetBySky']='OrdersController/GetProductBySkuID';
$route['OrdersByEngineer']='OrdersController/OrdersByEngineer';
$route['AwatingOrdersByEngineer']='OrdersController/AwatingOrdersByEngineer';
$route['OrdersByProject']='OrdersController/OrdersByProject';
$route['AwatingOrdersByProject']='OrdersController/AwatingOrdersByProject';
$route['DeleteOrder']='OrdersController/DeleteOrderFull';
$route['DeleteSingleOrder']='OrdersController/DeleteSingleOrder';
                                                              //close order section
                                                              //CatDetails
$route['CatDetails']='ProductCategoryController/CatDetails';
$route['subCatDetails']='ProductCategoryController/subCatDetails';
$route['DeleteCat']='ProductCategoryController/DeleteCat';
                                                          //UserAccount Details Api
$route['AccountDetails']='UserApiControll/UserAccount';
$route['changepass']='UserApiControll/ChangePassword';
                                                           //user app logut
$route['AppLogout']='UserApiControll/AppLogout';
                                                          //orderApi
$route['getorderbyapp']='OrdersController/getorderfromapp';
$route['getOrderInIos']='OrdersController/getorderfromiosapp';  //order iosapp
$route['viewmyorder']='OrdersController/SendOrderToApp';
$route['viewAwatingorder']='OrdersController/SendAwatingOrderToApp';
$route['viewmysingleorder']='OrdersController/SendSingleOrderToApp';
$route['approveorderbyadmin']='OrdersController/ApproveOrderbyAdmin';
$route['ApproveOrderApi']='OrdersController/ApproveOrderApi';
$route['Moredetails']="OrdersController/Moredetails";
$route['exportcsv']='OrdersController/exportCSV';
$route['OrderUnderProject']='OrdersController/OrderUnderProject';
$route['getordersbyselecteddays']='OrdersController/getordersbyselecteddays';
$route['toporderedproduct']='OrdersController/toporderedproduct';
/**********************new api for getorder or viewmysingle order**********************/
$route['NewSingleOrederApi']='OrdersController/NewSendSingleOrderToApp';
$route['NewGetOrderApi']='OrdersController/Newgetorderfromapp';
//Products 
$route['uploadcsvfilebyajax']='ProductController/uploadcsvfilebyajax';
$route['products'] = 'ProductController/Products';
$route['SelectSubCatById'] = 'ProductController/SelectSubCatById';
$route['delete_single_product'] = 'ProductController/Delete_single_product';
$route['AddProductVariation'] = 'ProductController/AddProductVariation';
$route['ViewProductVariation'] = 'ProductController/ViewProductVariation';
$route['variationpage'] = 'ProductController/VariationPage';
$route['deletevariationoption'] = 'ProductController/DeleteVariationOption';
$route['deletesinglevariation'] = 'ProductController/DeleteSingleVariation';
$route['EditSingleVariation'] = 'ProductController/EditSingleVariation';
$route['Edit_single_product'] = 'ProductController/EditProduct';
$route['updateproducts'] = 'ProductController/UpdateProducts';
$route['deleteproductimage'] = 'ProductController/DeleteProductImage';
$route['deleteproductpdf'] = 'ProductController/DeleteProductPdf';
$route['Getproductvariation']='ProductApiControl/Getproductvariation';
$route['CheckProductExsist']='ProductController/CheckProductExsist';
$route['Updatetaxclassvat']='ProductController/UpdateTaxClassVat';
$route['fetchdefaultprice']='ProductController/FetchDefaultPrice';
$route['uploadimagebyajax']='ProductController/imageuploadbyajax';
$route['ViewSingleProductVariation']='ProductController/ViewSingleProductVariation';
$route['FetchingDataFromLuckins']="ProductController/FetchingDataFromLuckins";
$route['ProductList']='ProductController/ProductList';
$route['UpdateProductListName']='ProductController/UpdateProductListName';
$route['ManageList']='ProductController/ManageList';
$route['GetListAndProduct']='ProductController/GetListAndProduct';
$route['RemoveListFromAProduct']='ProductController/RemoveListFromAProduct';
$route['ApplyCatFillterOnListProduct']='ProductController/ApplyCatFillterOnListProduct';
$route['ApplyFillterOnNormalProducts']='ProductController/ApplyFillterOnNormalProducts';
$route['ProductListTransfer']='ProductController/ProductListTransfer';
$route['Copy_List_Product']='ProductController/Copy_List_Product';
$route['assignmasterlist']='ProductController/assignmasterlist';
$route['CallMeForListProducts']='ProductController/CallMeForListProducts';
//Catelogues    
$route['cetalogues'] = 'CetaloguesController/Cetalogues';
$route['getcatelogues'] = 'CetaloguesController/GetCateLouges';
$route['deletecatelog'] = 'CetaloguesController/DeleteCateLouges';
$route['newCetalogues'] = 'Newcatalogcontroller/newCetalogues';
$route['newGetCateLouges'] = 'Newcatalogcontroller/newGetCateLouges';
$route['updatecatalog'] = 'Newcatalogcontroller/Updatecatalog'; 
$route['EditNewCatalogSection'] = 'Newcatalogcontroller/EditNewCatalogSection';
$route['DeleteNewCatalogSection'] = 'Newcatalogcontroller/DeleteNewCatalogSection';

//Project
$route['projects']='ProjectController/AddProjects';
$route['GetProjects']='ProjectController/SendProjectToAppApi';
$route['GetProjectsApp']='ProjectController/GetProjectsApp';
$route['sendprojectfromapp']='ProjectController/GetProjectFromAppApi';
$route['AddProjectFromApp']='ProjectController/CaddProjectFromApp';
$route['EditProjectFromApp']="ProjectController/EditProjectFromApp"; 
$route['EditProjectAndroid']="ProjectController/EditProjectAndroid"; 
$route['DeleteProjectFromApp']="ProjectController/DeleteProjectFromApp"; 
$route['EditProjectFromIosApp']="ProjectController/EditProjectFromIosApp";
$route['OrdersByProEngineer']="ProjectController/OrdersByProEngineer";
//api for ios to get project from ios app
$route['SendProjectFromIos']='ProjectController/GetProjectFromIos';
//category fillter
$route['getcatfillter']='ProductCategoryController/get_cat_fillter';
//category
$route['getsubcatbyajax']='ProductCategoryController/get_subcat_by_ajax';
$route['getsupersubcatbyajax']='ProductCategoryController/get_supersubcat_by_ajax';
$route['UpdateCatName']='ProductCategoryController/UpdateCatName';
$route['UpdateListName']='ProductCategoryController/UpdateListName';
$route['UpdateSubCatName']='ProductCategoryController/UpdateSubCatName';
$route['deletesub']='ProductCategoryController/DeleteSub';
$route['getbusinesscat']='ProductCategoryController/get_cat_by_ajax';
$route['categorylist']='ProductCategoryController/categorylist';
$route['catinsidelist']='ProductCategoryController/catinsidelist';
$route['DeleteList']='ProductCategoryController/DeleteList';          
$route['DeleteCatImages']="ProductCategoryController/DeleteCatImage";     
$route['changeCatImage']="ProductCategoryController/changeCatImage";  
$route['changeSubCatImage']="ProductCategoryController/changeSubCatImage";
$route['ChangeSupCatImage']="ProductCategoryController/ChangeSupCatImage";
$route['DeleteSupCatImages']="ProductCategoryController/DeleteSupCatImages"; 
 
//suppliers
$route['suppliers']='SupplierController/Supplier';
$route['GetSupplier']='SupplierController/SendSupplierToApp';
//set current business status for all section
$route['SetBusinessSection']='Welcome/Set_Business_Session';
//serchApi
$route['SearchKey']='SearchApiControl/Search';   
//oprative enginner api
$route['SendOprativeEnigineers']='EngineerController/SendOprativeEnigineers';
$route['SendOprativeEnigineersFromApp']='EngineerController/SendOprativeEnigineersFromApp';
//Notifications
$route['Notifications']='Welcome/SendNotification';
//copycatagory
$route['CategoryTransfer']='Welcome/CategoryTransfer';
$route['CategoriesListTransfer']='Welcome/CategoriesListTransfer';
//wholesaler 
$route['wholesaler']='Welcome/wholesaler'; 
$route['EditWholesaler']='EngineerController/EditWholeseller'; 
//user billing details api
$route['GetBillingDetails']='UserApiControll/UserBillingDetails'; 
$route['EditBillingAndShipping']='UserApiControll/EditBillingAndShipping';
//user delevery details api
$route['GetDeleveryDetails']='UserApiControll/EngineerDeleveryDetails'; 

//Send wholesellers to app
$route['SendSellersToApp']='UserApiControll/SendSellersToApp'; 
$route['SendCityList']='UserApiControll/SendCityList';
//Stripe payment api
$route['MakeAPayment']='UserApiControll/MakeAPayment';
//Stripe card api
$route['GetCards']='UserApiControll/UserCards';
//remove cards
$route['RemoveCard']='UserApiControll/RemoveCard';
//Add Card
$route['AddCard']='UserApiControll/AddCard';
//stripe connection_aborted
$route['StripeConnect']='Welcome/StripeConnect';

//Send Product To Atradeya
$route['SendAtradeyaProducts']='ProductApiControl/SendAtradeyaProducts';
//Send user To Atradeya
$route['SendUsertoAtradeya']='UserApiControll/SendUser';
//Atradeya app api
$route['GenratePasswordAndSendApi']='AtradeyaAppController/GenratePasswordAndSendApi';
$route['CreateAtradeyaAppUsers']='AtradeyaAppController/CreateAtradeyaAppUsers';
$route['AtradeyNewGetOrder']='AtradeyaAppController/AtradeyNewGetOrder';
//delevery cost
$route['Delevercost']='AtradeyaAppController/Delevercost';
$route['adddelevery']='AtradeyaAppController/AddDelevery';
$route['UpdateDeleveryCost']='AtradeyaAppController/UpdateDeleveryCost';
$route['deleteshipping']='AtradeyaAppController/deleteshipping';
$route['SendDeleveryCost']='AtradeyaAppController/SendDeleveryCost';
//stores    
$route['Stores']='AtradeyaAppController/Stores';
$route['EditStore/(:any)']="AtradeyaAppController/EditStore/$1";
$route['deletestore/(:any)']="AtradeyaAppController/deletestore/$1";
$route['SendStore']="AtradeyaAppController/SendStore";
//enginner all address
$route['Engineer_address_list']='EngineerController/Engineer_address_list';
$route['Send_enginner_alladdress']='EngineerController/Send_enginner_alladdress';
$route['Edit_enigneer_alladdress']='EngineerController/Edit_enigneer_alladdress';
$route['delete_enigneer_alladdress']='EngineerController/delete_enigneer_alladdress';
$route['Stores']='AtradeyaAppController/Stores';

/*********************Get product cat in react************************/
$route['getproductcategoryinReact'] = 'ProductApiControl/GetcategoryinReact';
/*********************************************************************/
//Fillter 
$route['fillter']="AtradeyaAppController/fillter";
$route['editfillter']="AtradeyaAppController/EditFillter";  
$route['ApplyFilter']="AtradeyaAppController/ApplyFilter";
//Quotes
$route['GetQuotes']="OrdersController/GetQuotes";
$route['UserQuotesGroup']="OrdersController/UserQuotesGroup";
$route['UserSingleQuotes']="OrdersController/UserSingleQuotes";   
$route['MakeAnOrderQuotes']="OrdersController/MakeAnOrderQuotes";
 
//INVOICE
$route['invoiceParserTest']="invoiceParserTest/FetchInvoiceAndStore";   
$route['invoicemangent']="InvoiceManagement/FetchInvoiceAndStore";
$route['invoiceView']="InvoiceManagement/invoiceView";
$route['invoiceProduct']="InvoiceManagement/invoiceProduct"; 
$route['AddInvoiceSetting']="InvoiceManagement/setupInvoiceEmail";
//credit
$route['creditManagement']="CreditManagement/FetchCreditAndStore";    
//quotesinvoice
$route['quotesManagent']="QuotesManagent/FetchQuotesAndStore";
//New theme routes
$route['GetAllBusiness']="Welcome/GetAllBusiness";
$route['AddNewBusiness']="Welcome/AddNewBusiness";
$route['UploadBussinessLogo']="Welcome/UploadBussinessLogo";
$route['deletelogo']="Welcome/deletelogo";  
$route['PrintHtmlTable']="Welcome/PrintHtmlTable";
$route['makeCsvFile']="Welcome/makeCsvFile";
$route['PrintPdfTable']="Welcome/PrintPdfTable";
$route['404_override'] = ''; 
$route['translate_uri_dashes'] = FALSE;


