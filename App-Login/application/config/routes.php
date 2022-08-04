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
$route['TrialBusiness'] = 'Welcome/TrialBusiness';  
$route['GetTrialBusiness'] = 'Welcome/GetTrialBusiness';
$route['dashboard'] = 'Welcome/login';
$route['ForgetPassword'] = 'Welcome/ForgetPassword';
$route['UserForgetPassword'] = 'Welcome/UserForgetPassword';   
$route['UpdatePassword'] = 'Welcome/UpdatePassword';
$route['SetPassword'] = 'Welcome/SetPassword';
$route['index'] = 'Welcome/index';
$route['users'] = 'Welcome/users';
$route['ManufacturerFetchfromvps'] = 'Welcome/ManufacturerFetchfromvps';   
$route['GetAllAttchmentCountData'] = 'Welcome/GetAllAttchmentCountData';   

$route['orders'] = 'OrdersController/Orders';
  
$route['category'] = 'ProductCategoryController/category';  
$route['SubCategory'] = 'ProductCategoryController/SubCategory';
$route['DeleteSubCategory'] = 'ProductCategoryController/DeleteSubCategory';   
$route['EditSubCategory'] = 'ProductCategoryController/EditSubCategory';
$route['GetAllSubCategory'] = 'ProductCategoryController/GetAllSubCategory';
$route['superSubCategory/(:num)'] = 'ProductCategoryController/superSubCategory';
$route['GetAllSuperSubCategory'] = 'ProductCategoryController/GetAllSuperSubCategory';
$route['DeleteSuperSubCategory'] = 'ProductCategoryController/DeleteSuperSubCategory';
$route['updateSubData'] = 'ProductCategoryController/updateSubData';
$route['EditSuperSubCategory/(:num)/(:num)'] = 'ProductCategoryController/EditSuperSubCategory';

$route['DeleteMultipleProducts'] = 'ProductCategoryController/DeleteMultipleProducts';
$route['publishedMultipleProducts'] = 'ProductCategoryController/publishedMultipleProducts';
$route['unpublishedMultipleProducts'] = 'ProductCategoryController/unpublishedMultipleProducts';
$route['user_verification'] = 'Welcome/User_verification';
$route['forgotpassword'] = 'Welcome/ForgotPassword';
$route['delete'] = 'Welcome/Remove';
$route['get_products'] = 'Welcome/Fetch_products';
$route['editbusiness'] = 'Welcome/Editbusiness';
$route['editusers'] = 'Welcome/Editusers';
$route['adminlogin'] = 'Welcome/Adminloginbysuperadmin';
$route['logout'] = 'LogControl/Logout';
$route['getproductcategory'] = 'ProductApiControl/Getcategory';
$route['GetProductSuperSubSubCategory'] = 'ProductApiControl/GetProductSuperSubSubCategory';
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
$route['GetWebBook/(:num)']='ProjectController/GetWebBook';   
$route['CreateOauthToken/(:num)']='ProjectController/create_oauth_token';
$route['StaffAllocation']='ProjectController/StaffAllocation';
$route['StaffAllocation1']='ProjectController/StaffAllocation1';  
$route['PostWebhookSubscriptions']='ProjectController/post_webhook_subscriptions';
$route['GetWebhookSubscriptions']='ProjectController/get_webhook_subscriptions';             
$route['DeleteWebhookSubscriptions']='ProjectController/delete_webhook_subscriptions';

//user section (user exisit or not)    
$route['checkuserexsist']='Welcome/CheckUserExsist';
$route['CheckNewUserExsist']='Welcome/CheckNewUserExsist'; 
// sql lukins route 
$route['GetLukinsProducts']='Welcome/GetLukinsProducts';
$route['GetLukinsproductsInproductList']='Welcome/GetLukinsproductsInproductList';    
$route['GetLukinsSubCategory']='Welcome/GetLukinsSubCategory';
$route['GetLukinsSubSubCategory']='Welcome/GetLukinsSubSubCategory';
$route['GetLukinsManufacture']='Welcome/GetLukinsManufacture';
$route['SqlLukinsProducts']='Welcome/SqlLukinsProducts';
$route['ExportProductInPMO']='Welcome/ExportProductInPMO';  
$route['GetProductInfo']='Welcome/GetProductInfo';
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
$route['ManageReorder']='OrdersController/ManageReorder';
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
$route['GrandSubCat']='ProductCategoryController/GrandSubCat'; 

$route['DeleteCat']='ProductCategoryController/DeleteCat';
                                                          //UserAccount Details Api
$route['AccountDetails']='UserApiControll/UserAccount';
$route['ListM8ServiceStaff']='UserApiControll/ListM8ServiceStaff';
$route['changepass']='UserApiControll/ChangePassword';
$route['CheckUserExist']='UserApiControll/CheckUserExist';
$route['GetBrands']='UserApiControll/GetBrands';
$route['GetBrandCategory']='UserApiControll/GetBrandCategory';
$route['GetWholesalercategory']='UserApiControll/GetWholesalercategory';
                                                           //user app logut
$route['AppLogout']='UserApiControll/AppLogout';
$route['NewGetVanOrder']='UserApiControll/NewGetVanOrder';
$route['VanStockReorder']='UserApiControll/VanStockReorder';
$route['AddVanReorder']='UserApiControll/AddVanReorder';
$route['orderone']='UserApiControll/orderone';
$route['AddToStock']='UserApiControll/AddToStock';



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

//Trial route  
$route['Trial/Index']='Welcome/TrialIndex';    
$route['CreateUserForTrial']='Welcome/CreateUserForTrial';     
$route['busineesCreateForTrial']='Welcome/busineesCreateForTrial';   
$route['AccountCreateForTrial']='Welcome/AccountCreateForTrial';
$route['loginTrialBase']='Welcome/loginTrialBase';
$route['AddBusinessForTrial']='Welcome/AddBusinessForTrial';
$route['paymentPackages']='Welcome/paymentPackages';
$route['CreateCheckoutSession']='Welcome/CreateCheckoutSession';  

$route['ManageListProducts/(:any)/(:num)'] = 'ProductController/ManageListProducts';
$route['GetAllListProducts'] = 'ProductController/GetAllListProducts';
$route['uploadcsvfilebyajax']='ProductController/uploadluckincsvfilebyajax';   
$route['uploadcsvfilebyajaxbulk']='ProductController/uploadcsvfilebyajax';
$route['products'] = 'ProductController/Products';
$route['AddProductsInList'] = 'ProductController/AddProductsInList';
$route['GenrateTokenForLuckin'] = 'ProductController/GenrateTokenForLuckin';
$route['LukinsFailureProducts'] ='ProductController/LukinsFailureProducts';
$route['GetLukinsFailureProducts'] = 'ProductController/GetLukinsFailureProducts';
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
$route['LuckinsProducts']='ProductController/LuckinsProducts';
$route['UpdateProductListName']='ProductController/UpdateProductListName';  
$route['ManageList']='ProductController/ManageList';
$route['GetListAndProduct']='ProductController/ ';
$route['RemoveListFromAProduct']='ProductController/RemoveListFromAProduct';
$route['copypmoproductsinproductsList']='ProductController/copypmoproductsinproductsList';
$route['ApplyCatFillterOnListProduct']='ProductController/ApplyCatFillterOnListProduct';
$route['ApplyFillterOnNormalProducts']='ProductController/ApplyFillterOnNormalProducts';
$route['ProductListTransfer']='ProductController/ProductListTransfer';
$route['Copy_List_Product']='ProductController/Copy_List_Product';
$route['assignmasterlist']='ProductController/assignmasterlist';    
$route['CallMeForListProducts']='ProductController/CallMeForListProducts';
$route['AddVanStock']='ProductController/AddVanStock';
$route['DeleteProductList']='ProductController/DeleteProductList';
$route['AddCategoryInListCategory']="ProductController/AddCategoryInListCategory";  
$route['AddCategoryInCategoryList']="ProductController/AddCategoryInCategoryList";   
$route['GetCategoryForCategorylist']="ProductController/GetCategoryForCategorylist";   
$route['DeleteCategoryForCategorylist']="ProductController/DeleteCategoryForCategorylist";
$route['CopyCategoryInAnotherList']="ProductController/CopyCategoryInAnotherList";
$route['InsertLukinsTempData']='ProductController/InsertLukinsTempData';
$route['GetVanCat']='ProductApiControl/GetVanCat';
$route['GetVanSubCat']='ProductApiControl/GetVanSubCat';



//Catelogues    
$route['cetalogues'] = 'CetaloguesController/Cetalogues';
$route['getcatelogues'] = 'CetaloguesController/GetCateLouges';
$route['deletecatelog'] = 'CetaloguesController/DeleteCateLouges';
$route['categoryLists'] = 'CetaloguesController/categoryLists';
$route['newCetalogues'] = 'Newcatalogcontroller/newCetalogues';
$route['newGetCateLouges'] = 'Newcatalogcontroller/newGetCateLouges';
$route['Shelves'] = 'Newcatalogcontroller/Shelves';
$route['updatecatalog'] = 'Newcatalogcontroller/Updatecatalog'; 
$route['EditNewCatalogSection'] = 'Newcatalogcontroller/EditNewCatalogSection';  
$route['DeleteNewCatalogSection'] = 'Newcatalogcontroller/DeleteNewCatalogSection'; 
$route['EditCatalogs'] = 'Newcatalogcontroller/EditCatalogs';  
$route['UploadCatalogs'] = 'Newcatalogcontroller/UploadCatalogs';    
$route['DeleteCatalogs'] = 'Newcatalogcontroller/DeleteCatalogs'; 
$route['AddShelves'] = 'Newcatalogcontroller/AddShelves';  
$route['FetchShelves'] = 'Newcatalogcontroller/FetchShelves';    
$route['DeleteShelves'] = 'Newcatalogcontroller/DeleteShelves';
$route['EditShelves'] = 'Newcatalogcontroller/EditShelves';  
$route['LockShelve'] = 'Newcatalogcontroller/LockShelve'; 
$route['InsertEditShelve'] = 'Newcatalogcontroller/InsertEditShelve';  
$route['ManageCatalogSection'] = 'Newcatalogcontroller/ManageCatalogSection';  
$route['GetSetOrderIds'] = 'Newcatalogcontroller/GetSetOrderIds';  
$route['GetSetOrderIdsCatalog'] = 'Newcatalogcontroller/GetSetOrderIdsCatalog';  
$route['GetSetOrderIdsShelve'] = 'Newcatalogcontroller/GetSetOrderIdsShelve';
$route['GetSectionByShelve'] = 'Newcatalogcontroller/GetSectionByShelve';




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
$route['ImpotCatWithCsvFile']='ProductCategoryController/ImpotCatWithCsvFile';
$route['getsupersubsubcatbyajax']='ProductCategoryController/get_super_sub_sub_subcat_by_ajax';
$route['UpdateCatName']='ProductCategoryController/UpdateCatName';
$route['UpdateListName']='ProductCategoryController/UpdateListName';
$route['UpdateSubCatName']='ProductCategoryController/UpdateSubCatName';
$route['updatesupersubcat']='ProductCategoryController/updatesupersubcat';
$route['deletesub']='ProductCategoryController/DeleteSub';
$route['getbusinesscat']='ProductCategoryController/get_cat_by_ajax';
$route['categorylist']='ProductCategoryController/categorylist';
$route['catinsidelist']='ProductCategoryController/catinsidelist';
$route['DeleteList']='ProductCategoryController/DeleteList';                         
$route['DeleteCatImages']="ProductCategoryController/DeleteCatImage";
$route['DeletesubCatImagewithajax']="ProductCategoryController/DeletesubCatImagewithajax"; 
$route['DeletesubsubCatImage']="ProductCategoryController/DeletesubsubCatImage";   
  
$route['changeCatImage']="ProductCategoryController/changeCatImage";  
$route['changeSubCatImage']="ProductCategoryController/changeSubCatImage";  
$route['ChangeSupCatImage']="ProductCategoryController/ChangeSupCatImage";
$route['ChangesubsubCatImage']="ProductCategoryController/ChangesubsubCatImage";
$route['DeleteSupCatImages']="ProductCategoryController/DeleteSupCatImages"; 
$route['UpdateProductsWithCsvFile']="ProductCategoryController/UpdateProductsWithCsvFile";   
$route['CatCopyfromList']="ProductCategoryController/CatCopyfromList"; 
$route['ChangeCatimages']="ProductCategoryController/ChangeCatimages"; 
$route['UpdateCatImage']="ProductCategoryController/UpdateCatImage"; 
 
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
$route['RenameLukinsCategory']='Welcome/RenameLukinsCategory';
$route['CategoriesListTransfer']='Welcome/CategoriesListTransfer';
$route['changecatname']='Welcome/changecatname';
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
$route['GetAllAdvertisment']="UserApiControll/GetAllAdvertisment"; 
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
//$route['Delevercost']='AtradeyaAppController/Delevercost';
$route['AddNewDeleverCost']='AtradeyaAppController/Delevercost';
$route['Delevercost']='AtradeyaAppController/Delevercost';
$route['UpdateDeleveryCost']='AtradeyaAppController/UpdateDeleveryCost';
$route['deleteshipping']='AtradeyaAppController/deleteshipping';
$route['SendDeleveryCost']='AtradeyaAppController/SendDeleveryCost';
//stores    
//$route['Stores']='AtradeyaAppController/Stores';
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
$route['EmailConnectWithNylas']="InvoiceManagement/EmailConnectWithNylas";
$route['TrigerEmailsData']="InvoiceManagement/TrigerEmailsData";
$route['DeleteNyalsAccount/(:num)']="InvoiceManagement/DeleteNyalsAccount";
$route['SendNylasAttachmentInAws']="InvoiceManagement/SendNylasAttachmentInAws";
$route['GEtjsonFilesFromAws']="InvoiceManagement/GEtjsonFilesFromAws";
$route['Invoice']="InvoiceManagement/Invoice";
$route['SetUp']="InvoiceManagement/SetUp";
$route['FetchInvoices']="InvoiceManagement/FetchInvoices";
$route['pdfview/(:num)/(:any)']="InvoiceManagement/pdfview";
$route['InsertUsersDomians']="InvoiceManagement/InsertUsersDomians";
$route['SetupUserDomain']="InvoiceManagement/SetupUserDomain";
$route['DeleteDomain']="InvoiceManagement/DeleteDomain";
$route['EditSingleDomain']="InvoiceManagement/EditSingleDomain";
$route['Quotation']="InvoiceManagement/Quotation";
$route['Creditnote']="InvoiceManagement/Creditnote";
$route['FetchCreditnote']="InvoiceManagement/FetchCreditnote";
$route['FetchQuotation']="InvoiceManagement/FetchQuotation";
$route['EditDomains/(:num)']="InvoiceManagement/EditDomains";
$route['AssociatedInvoice/(:any)']="InvoiceManagement/AssociatedInvoice";
$route['AddCommentToAttachment']="InvoiceManagement/AddCommentToAttachment";      
$route['GlobalSupliers']="InvoiceManagement/GlobalSupliers";
$route['AddNewGlobalSuppliers']="InvoiceManagement/AddNewGlobalSuppliers";
$route['AddNewSingleGlobalSupplier']="InvoiceManagement/AddNewSingleGlobalSupplier";
$route['FetchAllGlobalSuppliers']="InvoiceManagement/FetchAllGlobalSuppliers";
$route['DeleteSingleSuplierLogo']="InvoiceManagement/DeleteSingleSuplierLogo";
$route['DeleteSingleSuplier/(:num)']="InvoiceManagement/DeleteSingleSuplier";
$route['EditSingleSuplier/(:num)']="InvoiceManagement/EditSingleSuplier";
$route['EditSingleGlobalSupplier']="InvoiceManagement/EditSingleGlobalSupplier";
$route['invoiceNylasAttachmentDetails/(:any)/(:any)'] = 'InvoiceManagement/invoiceNylasAttachmentDetails';
$route['invoiceIndividualDetails'] = 'InvoiceManagement/invoiceIndividualDetails';
$route['same/order/number'] = 'InvoiceManagement/FetchInvoicesSameOrderNumber';
$route['productCatalogue'] = 'InvoiceManagement/productCatalogue';
$route['productCatalogueDataFetch'] = 'InvoiceManagement/productCatalogueDataFetch';
$route['AllcateProjectToInvoice'] = 'InvoiceManagement/AllcateProjectToInvoice';
$route['FetchInvoiceUnderProject/(:num)']="InvoiceManagement/FetchInvoiceUnderProject";
$route['InvoiceUnderProject/(:num)'] = 'InvoiceManagement/InvoiceUnderProject';
$route['UpdateInvoiceFlagValue']="InvoiceManagement/UpdateInvoiceFlagValue";  
$route['DeleteInvoice']="InvoiceManagement/DeleteInvoice";
$route['UpdateINvoice']="InvoiceManagement/UpdateINvoice";
$route['FetchAllStatement']="InvoiceManagement/FetchAllStatement";
$route['GEtjsonFilesFromAwsToStatement']="InvoiceManagement/GEtjsonFilesFromAwsToStatement";
$route['Statement']="InvoiceManagement/Statement";
$route['ViewStatements/(:num)'] = 'InvoiceManagement/ViewStatements';
$route['FetchViewStatement/(:num)'] = 'InvoiceManagement/FetchViewStatement';
$route['CreteOrderToqoute']="InvoiceManagement/CreteOrderToqoute";
$route['SaveSetupChange']="InvoiceManagement/SaveSetupChange";
$route['CronSetUpForStopAttachmentToSave']="InvoiceManagement/CronSetUpForStopAttachmentToSave";
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
$route['Printproductstable']="Welcome/Printproductstable";
$route['makeCsvFile']="Welcome/makeCsvFile";
$route['PrintPdfTable']="Welcome/PrintPdfTable"; 
// NewThemeCustomization Controller  
$route['ChangeStatusCategory']="NewThemeController/ChangeStatusCategory";
$route['Getsubsubcategorycat']="NewThemeController/Getsubsubcategorycat";
$route['Getsubcategorycat']="NewThemeController/Getsubcategorycat";
$route['AddNewAdminUsers']="NewThemeController/AddNewAdminUsers";
$route['getBusinessUsers']="NewThemeController/getBusinessUsers";
$route['getNewSuppliers']="NewThemeController/getNewSuppliersPage";
$route['SendDataInPmoSupplierPageFromXero']="NewThemeController/SendDataInPmoSupplierPageFromXero";
$route['GetAllNewSuppliers']="NewThemeController/GetAllNewSuppliers";
$route['AddNewProjects']="NewThemeController/AddNewProjects";
$route['GetAllNewProjects']="NewThemeController/GetAllNewProjects";
$route['GetAllEngineer']="NewThemeController/GetAllEngineer";     
$route['AddNewEngineer']="NewThemeController/AddNewEngineer";    
$route['printAdminUserTable']="NewThemeController/printAdminUserTable";
$route['csvUserAdmin']="NewThemeController/makeCsvFileForUsers";
$route['PrintPdfTableForUser']="NewThemeController/PrintPdfTableForUser";
$route['AddNewWholsalerEnginner']="NewThemeController/AddNewWholsalerEnginner";
$route['printProjectTable']="NewThemeController/printProjectTable";
$route['GetWholsalerEngineer']="NewThemeController/GetWholsalerEngineer";
$route['AddNewWholesaller']="NewThemeController/AddNewWholesaller";
$route['GetNewDeleveryCost']="NewThemeController/GetNewDeleveryCost";
$route['AddNewDeleverCost']="NewThemeController/AddNewDeleverCost";
$route['PrintEngineerTable']="NewThemeController/PrintEngineerTable";  
$route['PrintWholeSellerTable']="NewThemeController/PrintWholeSellerTable";  
$route['GetOurStoreSection']="NewThemeController/GetOurStoreSection";
$route['deleteStoreSection']="NewThemeController/deleteStoreSection";
$route['AddNewThemeStore']="NewThemeController/AddNewThemeStore";
$route['GetAllNewProductList']="NewThemeController/GetAllNewProductList";
//$route['ProductList']="NewThemeController/ProductList";
$route['AddNeThemeProduct']="NewThemeController/AddNeThemeProduct";
$route['AddNewProductList']="NewThemeController/AddNewProductList";
$route['GetNewThemeAllOrder']="NewThemeController/GetNewThemeAllOrder";
$route['GetNewThemeAllAwatingOrder']="NewThemeController/GetNewThemeAllAwatingOrder";
$route['AwtingOrderView']="NewThemeController/AwtingOrderView";
$route['GetNewThemeOrderUnderProject']="NewThemeController/GetNewThemeOrderUnderProject";
$route['GetNewThemeAllQuotes']="NewThemeController/GetNewThemeAllQuotes";
$route['EditNewProductList']="NewThemeController/EditNewProductList";
$route['PrintPdfTableForproject']="NewThemeController/PrintPdfTableForproject";
$route['PrintPdfTableForEngineer']="NewThemeController/PrintPdfTableForEngineer";
$route['PrintPdfTableForSuppliers']="NewThemeController/PrintPdfTableForSuppliers";
$route['PrintPdfTableForStores']="NewThemeController/PrintPdfTableForStores";
$route['PrintPdfTableForDelevercost']="NewThemeController/PrintPdfTableForDelevercost";
$route['PrintPdfTableForusers']="NewThemeController/PrintPdfTableForusers";
$route['PrintPdfTableFororder']="NewThemeController/PrintPdfTableFororder";
$route['MakeCsvFileForProjects']="NewThemeController/MakeCsvFileForProjects";
$route['MakeCsvFileForstore']="NewThemeController/MakeCsvFileForstore";
$route['MakeCsvFileFordeleverycost']="NewThemeController/MakeCsvFileFordeleverycost";
$route['MakeCsvFileFororders']="NewThemeController/MakeCsvFileFororders";
$route['MakeCsvFileForuser']="NewThemeController/MakeCsvFileForuser";
$route['MakeCsvFileForProductList']="NewThemeController/MakeCsvFileForProductList";
$route['MakeCsvFileForEngineer']="NewThemeController/MakeCsvFileForEngineer";
$route['MakeCsvFileForsuppliers']="NewThemeController/MakeCsvFileForsuppliers";
$route['printTableForSuppliers']="NewThemeController/printTableForSuppliers";
$route['printTableForOrders']="NewThemeController/printTableForOrders";
$route['printTableForBusiness']="NewThemeController/printTableForBusiness";
$route['GenratePdfForBusiness']="NewThemeController/GenratePdfForBusiness";
$route['GetNewThemeProducts']="NewThemeController/GetNewThemeProducts";
$route['SendNewThemeNotification']="NewThemeController/SendNewThemeNotification";
$route['Notifictions']="NewThemeController/Notifictions";
$route['GetAllNtofications']="NewThemeController/GetAllNtofications";
$route['DeleteNotification']="NewThemeController/DeleteNotification";
$route['DeleteProducts']="NewThemeController/DeleteProducts";
$route['GetAllDataQuotes']="NewThemeController/GetAllDataQuotes";
$route['GetCatOnNewTheme']="NewThemeController/GetCatOnNewTheme";
$route['AddNewThemeCat']="NewThemeController/AddNewThemeCat";
$route['EditNewThemeCategory']="NewThemeController/EditNewThemeCategory";
$route['changeCatNewTheme']="NewThemeController/changeCatNewTheme";
$route['NewThemeFillter']="NewThemeController/NewThemeFillter";
$route['AddNewThemeFilter']="NewThemeController/AddNewThemeFilter";    
$route['GetNumberEngineers']="NewThemeController/GetNumberEngineers"; 
$route['GetNumberSupplier']="NewThemeController/GetNumberSupplier";
/*********************/
$route['vanstock']="NewThemeController/vanstock";
$route['Getvanstock']="NewThemeController/Getvanstock";
$route['DeliveryCollection']="NewThemeController/DeliveryCollection";
$route['CollectionDelivery']="NewThemeController/CollectionDelivery";
$route['Vans']="NewThemeController/Vans";
$route['AddNewVans']="NewThemeController/AddNewVans";
$route['insertvans']="NewThemeController/insertvans";
$route['GetAllVans']="NewThemeController/GetAllVans";
$route['Deletevans']="NewThemeController/Deletevans";
$route['Editvans']="NewThemeController/Editvans";
$route['Updatevans']="NewThemeController/Updatevans";
$route['ReorderProducts']="NewThemeController/ReorderProducts";
$route['listReorderProducts']="NewThemeController/listReorderProducts";    
$route['VanReorder']="NewThemeController/VanReorder";
$route['VanEngineer']="NewThemeController/VanEngineer";
$route['ListEngineer']="NewThemeController/ListEngineer";  
$route['AddEngineer']="NewThemeController/AddEngineer";
$route['vanAllProducts']="VanStockController/vanAllProducts";   
$route['FetchvanAllProducts']="VanStockController/FetchvanAllProducts";
$route['DeleteVanAllProducts']="VanStockController/DeleteVanAllProducts";  
$route['UpdateAllProduct']="VanStockController/UpdateAllProduct";
$route['UpdateAllProducts']="VanStockController/UpdateAllProducts";   
$route['Fetchproductcode']="VanStockController/Fetchproductcode";   
$route['InsertVanEngineer']="VanStockController/InsertVanEngineer";
$route['VanEngineers']="VanStockController/VanEngineers";      
$route['FetchVanEngineers']="VanStockController/FetchVanEngineers"; 
$route['DeleteVanEngineers']="VanStockController/DeleteVanEngineers";
$route['InsertVanProducts']="VanStockController/InsertVanProducts"; 
$route['VanAllOrder']="VanStockController/VanAllOrder";  
$route['GetVanAllOrder']="VanStockController/GetVanAllOrder";    
$route['FetchVanEngineer']="VanStockController/FetchVanEngineer";         
$route['PrintPdfTableForProducts']="VanStockController/PrintPdfTableForProducts";   
$route['MakeCsvFileForProducts']="VanStockController/MakeCsvFileForProducts";
$route['MakeCsvFileForvanstock']="VanStockController/MakeCsvFileForvanstock";     
$route['PrintPdfTableForvanstock']="VanStockController/PrintPdfTableForvanstock";  
$route['PrintvanstockTable']="VanStockController/PrintvanstockTable"; 
$route['PrintvansTable']="VanStockController/PrintvansTable";   
$route['MakeCsvFileForvans']="VanStockController/MakeCsvFileForvans";  
$route['PrintPdfTableForvans']="VanStockController/PrintPdfTableForvans";   
$route['PrintReorderProductsTable']="VanStockController/PrintReorderProductsTable";   
$route['MakeCsvFileForReorderproducts']="VanStockController/MakeCsvFileForReorderproducts";   
$route['PrintPdfTableReorderproduct']="VanStockController/PrintPdfTableReorderproduct"; 
$route['PrintVanProductsTable']="VanStockController/PrintVanProductsTable";   
$route['PrintPdfTablevanproducts']="VanStockController/PrintPdfTablevanproducts";     
$route['MakeCsvFileForvanProducts']="VanStockController/MakeCsvFileForvanProducts";  
$route['PrintQuotesTable']="VanStockController/PrintQuotesTable";         
$route['MakeCsvFileForQuotes']="VanStockController/MakeCsvFileForQuotes";
$route['PrintPdfTableQuotes']="VanStockController/PrintPdfTableQuotes";
$route['VanstockGet']="VanStockController/VanstockGet";  
$route['TransferShelves']="VanStockController/TransferShelves";
$route['CopyAllShelve']="VanStockController/CopyAllShelve"; 
$route['GetShelveByBusiness']="VanStockController/GetShelveByBusiness";  
$route['CategoryList']="VanStockController/CategoryList"; 
$route['AddNewCategoryList']="VanStockController/AddNewCategoryList"; 
$route['InsertCatList']="VanStockController/InsertCatList"; 
$route['FetchCategoryList']="VanStockController/FetchCategoryList"; 
$route['DeleteCategoryList']="VanStockController/DeleteCategoryList"; 
$route['UpdateCategoryList']="VanStockController/UpdateCategoryList";
$route['EditCategoryList']="VanStockController/EditCategoryList";         
$route['integrateServiceM8']="VanStockController/integrateServiceM8";
$route['GetAllCatsData']="VanStockController/GetAllCatsData";
$route['MakeCsvFileForShopify']="VanStockController/MakeCsvFileForShopify"; 
$route['Advertisment']="VanStockController/Advertisment";  
$route['AddNewAdvertisment']="VanStockController/AddNewAdvertisment";
$route['Editads']="VanStockController/EditAdvertisment";
$route['Fetchads']="VanStockController/Fetchads";
$route['Deleteads']="VanStockController/Deleteads";
$route['DeleteAdsSource']="VanStockController/DeleteAdsSource";
$route['ReEnterAdvertisment']="VanStockController/ReEnterAdvertisment";
$route['updatecarousel']="VanStockController/updatecarousel";

$route['GetLukinsManufactureInProductList']="ElectricalCatalogueController/GetLukinsManufactureInProductList";
$route['FetchAllLukinsdata']='ElectricalCatalogueController/FetchAllLukinsdata';
$route['ExportProductInPMOList']='ElectricalCatalogueController/ExportProductInPMOList';  
$route['FilterProductListProduct']='ElectricalCatalogueController/FilterProductListProduct';
$route['FilterProductListProduct2']='ElectricalCatalogueController/FilterProductListProduct2';
$route['FilterProductListProduct3']='ElectricalCatalogueController/FilterProductListProduct3'; 

$route['callXero']='XeroController/callXero';
$route['XeroCallBackFunction']='XeroController/XeroCallBackFunction';
$route['XeroauthorizedResource']='XeroController/XeroauthorizedResource';
$route['createBill']='XeroController/createBill';
$route['CheckAccountInXero']='XeroController/CheckAccountInXero';
$route['ReconnectwithXero']='XeroController/ReconnectwithXero';

$route['404_override'] = '';     
$route['translate_uri_dashes'] = FALSE;


