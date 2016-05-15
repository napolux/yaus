<?php
namespace YAUS\Controller;

use Slim\Http\Request;
use Slim\Http\Response;


class AdminUrlController extends AbstractAdminController
{
    /**
     * @param Request $request
     * @param Response $response
     * @param $args
     * @return Response
     * @throws \Exception
     */
    public function listUrls(Request $request, Response $response, $args) {
        /** @var \YAUS\Resource\UrlResource $urlRes */
        $urlRes = $this->resources['urls'];

        $pageNumber = (!empty($args['page'])) ? $args['page'] : 1;

        $body = $this->view->fetch('admin/pages/urls.twig', [
            'title'       => 'Urls',
            'urls'        => $urlRes->getPage($pageNumber),
            'pageNumber'  => $pageNumber,
            'pageBaseUrl' => '/admin/urls',
            'totalPages'  => $urlRes->getTotalPages(),
            'message'     => $this->resources['flash']->getMessage('result')
        ]);

        return $response->write($body);
    }

    public function deleteUrl(Request $request, Response $response, $args) {
        if(empty($args['id']) || !is_numeric($args['id'])) {
            throw new \Exception('Missing or invalid url id');
        }

        // Deleting...
        /** @var \YAUS\Resource\UrlResource $urlRes */
        $urlRes = $this->resources['urls'];

        $urlRes->delete($args['id']);

        // Set flash message for next request
        $this->resources['flash']->addMessage('result', 'Url deleted');

        // Redirect
        return $response->withStatus(302)
            ->withHeader('Location', '/admin/urls');
    }

    public function addUrl(Request $request, Response $response, $args) {

        $params = $request->getParams();

        if(empty($params['url'])) {
            throw new \Exception('Missing or invalid form data');
        }

        // Adding hash for unique URLs
        $params['hash'] = md5($params['url']);

        /** @var \YAUS\Resource\UrlResource $urlRes */
        $urlRes = $this->resources['urls'];

        try {
            $urlRes->add(new \YAUS\Entity\Url(), $params);
        } catch(\Exception $e) {
            $this->resources['flash']->addMessage('result', 'Url "'. $params['url'] . '"cannot be added (it\'s probably a duplicate)');
        }

        // Set flash message for next request
        $this->resources['flash']->addMessage('result', 'Url "'. $params['url'] . '" added');

        // Redirect
        return $response->withStatus(302)
            ->withHeader('Location', '/admin/urls');
    }

    public function editUrl(Request $request, Response $response, $args) {

        $params = $request->getParams();

        if(empty($params['url']) || empty($params['id'])) {
            throw new \Exception('Missing or invalid form data');
        }

        // Adding hash for unique URLs
        $params['hash'] = md5($params['url']);

        /** @var \YAUS\Resource\UrlResource $urlRes */
        $urlRes = $this->resources['urls'];

        try {
            $urlRes->edit(new \YAUS\Entity\Url(), $params);
        } catch(\Exception $e) {
            $this->resources['flash']->addMessage('result', 'Url "'. $params['url'] . '"cannot be changed (the new URL is probably a duplicate)');
        }
        
        // Set flash message for next request
        $this->resources['flash']->addMessage('result', 'Url "'. $params['url'] . '" changed');

        // Redirect
        return $response->withStatus(302)
            ->withHeader('Location', '/admin/urls');
    }

}
