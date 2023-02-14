<?php


namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\Upload;
use App\Models\BannerModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\Response;

class Banner extends BaseController
{
    use ResponseTrait;


    /**
     * Used to view all banners
     * 
     */
    public function index()
    {
        $bannerModel = new BannerModel();
        //The method is not deprecated, the optional [$upper] parameter is deprecated.
        if ($this->request->getMethod() == 'get') {
            $bannerStatus = $this->request->getGet('banner_status');
            $filterData = [
                'status'    => $bannerStatus,
            ];
            $bannerModel->filter($filterData);
        }

        $data = [
            'banners' => $bannerModel->paginate(10),
            'pager'      => $bannerModel->pager
        ];
        return view('Admin/Banner/index', $data);
    }

    /**
     * Used to view banner infomation 
     * 
     */
    public function detail()
    {
        $bannerId = $this->request->getUri()->getSegment(4);
        $bannerModel = new BannerModel();

        if (!$bannerId) {
            $data['title'] = "Thêm Mới Banner";
            return view('Admin/Banner/detail', $data);
        }

        $banner = $bannerModel->find($bannerId);
        if (!$banner) {
            return redirect()->to('dashboard/banner/index');
        }

        $data['title'] = "Chỉnh Sửa Banner";
        $data['banner'] = $banner;
        return view('Admin/Banner/detail', $data);
    }

    /**
     * Combination of create and update that will attempt to determine whether the data should be inserted or updated.
     * 
     */
    public function save()
    {
        $bannerId     = $this->request->getPost('banner_id');
        $bannerName   = $this->request->getPost('name');
        $bannerTitle  = $this->request->getPost('description');
        $bannerLink   = $this->request->getPost('link');
        $bannerStatus = $this->request->getPost('status');

        $data = [
            'name'   => $bannerName,
            'description'  => $bannerTitle,
            'link'   => $bannerLink,
            'status' => $bannerStatus
        ];

        $upload = new Upload();
        $image = $upload->singleImages($this->request->getFiles()['image'][0], BANNER_IMAGE_PATH);
        if ($image) {
            $data['image']  = $image;
        }

        if ($bannerId) {
            $data['id'] = $bannerId;
        }

        $bannerModel = new BannerModel();
        if (!$bannerModel->save($data)) {
            return redirect_with_message(site_url('dashboard/banner/detail/' . $bannerId ? $bannerId : ''), UNEXPECTED_ERROR_MESSAGE);
        }
        return redirect()->to('dashboard/banner');
    }

    /**
     * Used to change status of a banner
     * 
     */
    public function changeStatus()
    {
        //get banner id from post data
        $id = $this->request->getPost('id');
        if (!$id) {
            return $this->respond(responseFailed(), Response::HTTP_OK);
        }

        $data['status'] = $this->request->getPost('status');
        $bannerModel = new BannerModel();
        $is_update = $bannerModel->update($id, $data);
        if (!$is_update) {
            return $this->respond(responseFailed(), Response::HTTP_OK);
        }

        return $this->respond(responseSuccessed(), Response::HTTP_OK);
    }


    /**
     * Used to delete a banner
     * 
     */
    public function delete()
    {
        $id = $this->request->getPost('id');
        if (!$id) {
            return $this->respond(responseFailed(), Response::HTTP_OK);
        }

        //delete banner
        $bannerModel = new BannerModel();

        $bannerImage = $bannerModel->first($id)['image'];
        $imagePath = BANNER_IMAGE_PATH . $bannerImage;
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        $isDelete = $bannerModel->delete($id);
        if (!$isDelete) {
            return $this->respond(responseFailed(), Response::HTTP_OK);
        }
        return $this->respond(responseSuccessed(), Response::HTTP_OK);
    }
}
