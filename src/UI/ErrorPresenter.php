<?php declare(strict_types = 1);

namespace Contributte\Nella\UI;

use Nette\Application\BadRequestException;
use Nette\Application\Helpers;
use Nette\Application\IPresenter;
use Nette\Application\Request as AppRequest;
use Nette\Application\Response as AppResponse;
use Nette\Application\Responses\CallbackResponse;
use Nette\Application\Responses\ForwardResponse;
use Nette\Http\IRequest as HttpRequest;
use Nette\Http\Response as HttpResponse;
use Tracy\ILogger;

class ErrorPresenter implements IPresenter
{

	private ILogger $logger;

	public function __construct(ILogger $logger)
	{
		$this->logger = $logger;
	}

	public function run(AppRequest $request): AppResponse
	{
		$e = $request->getParameter('exception');

		if ($e instanceof BadRequestException) {
			$this->logger->log('HTTP code ' . $e->getCode() . ': ' . $e->getMessage() . ' in ' . $e->getFile() . ' : ' . $e->getLine(), 'access');

			[$module, , $sep] = Helpers::splitName($request->getPresenterName());

			return new ForwardResponse($request->setPresenterName($module . $sep . 'Error4xx'));
		}

		$this->logger->log($e, ILogger::EXCEPTION);

		return new CallbackResponse(function (HttpRequest $httpRequest, HttpResponse $httpResponse): void {
			if (preg_match('#^text/html(?:;|$)#', (string) $httpResponse->getHeader('Content-Type')) !== false) {
				require __DIR__ . '/Templates/500.phtml';
			} elseif (preg_match('#^application/json(?:;|$)#', (string) $httpResponse->getHeader('Content-Type')) !== false) {
				require __DIR__ . '/Templates/500.phtml';
			}
		});
	}

}
