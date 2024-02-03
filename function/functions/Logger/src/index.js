import logzio from 'logzio-nodejs'

export default async ({ req, res, error }) => {
    try {
        if(!process.env.LOGZIO_TOKEN) {
            throw 'LOGZIO_TOKEN variable not set'
        }

        if(typeof req.body == 'string') {
            throw 'The body is not in JSON format'
        }

        if(!req.body?.message) {
            throw 'message parameter not provided'
        }

        const params = req.body?.params ?? {}
        const logger = logzio.createLogger({
            token: process.env.LOGZIO_TOKEN,
            protocol: 'https',
            host: 'listener.logz.io',
            port: '8071',
            type: process.env.LOGZIO_LOG_TYPE || 'nodejs'
        })
        logger.log({
            message: req.body.message,
            tags: req.body?.tags?.split(',') ?? [],
            ...params
        })
        logger.sendAndClose()
        return res.json({})
    } catch(e) {
        error(e)
        return res.json({}, 400)
    }
};
